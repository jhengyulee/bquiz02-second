<fieldset>
    <legend>目前位置:首頁 > 最新文章區</legend>
    <table>
        <tr class="ct">
            <td width='30%'>標題</td>
            <td width='50%'>內容</td>
            <td></td>
        </tr>
        <!-- 分頁設定 -->
        <?php
        $all=$News->math('count','id',['sh'=>1]);
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;
        // 分頁設定結束
        
        $rows=$News->all(['sh'=>1]," limit $start,$div");
        
        foreach($rows as $row){
        ?>        
        <tr>

            <td class="clo title" style="cursor:pointer"><?=$row['title'];?></td>
            <td>
                <span class="summary"><?=mb_substr($row['text'],0,20);?>...</span>
                <span class="full" style="display:none"><?=$row['text'];?></span>
            </td>
            <!-- 讚的顯示start -->
            <td>
                <?php
                    if(isset($_SESSION['user'])){
                        if($Log->math('count','id',['news'=>$row['id'],'user'=>$_SESSION['user']])>0){
                            echo "<a class='great' href='#' data-id='{$row['id']}'>收回讚</a>";
                        }else{
                            echo "<a class='great' href='#' data-id='{$row['id']}'>讚</a>";
                        }
                    }
                ?>
            </td>
            <!-- 讚的顯示end -->
        </tr>
        
        <?php    
        }
        ?>
    </table>
        <!-- 分頁顯示開始 -->
        <div class="ct">
            <?php
            if(($now-1)>0){
                $p=$now-1;
                echo "<a href='?do=news&p={$p}'> < </a>";
            }

            for($i=1;$i<=$pages;$i++){
                $fontsize=($now==$i)?'24px':'18px';
                echo "<a href='?do=news&p={$i}' style='font-size:{$fontsize}'> $i </a>";
            }

            if(($now+1)<=$pages){
                $p=$now+1;
                echo "<a href='?do=news&p={$p}'> > </a>";
            }

            ?>
        </div>
        <!-- 分頁顯示結束 -->
</fieldset>

<script>
        $('.title').on("click",function(){
            $(this).next().children().toggle();
        })


        $('.great').on("click",function(){
            let type=$(this).text() //   讚/收回讚
            let num=parseInt($(this).siblings('span').text())
            let id=$(this).data('id')

                $.post('./api/good.php',{type,id},()=>{
                    if(type==="讚"){
                        $(this).text("收回讚")
                        $(this).siblings('span').text(num+1)
                    }else{
                        $(this).text("讚")
                        $(this).siblings('span').text(num-1)
                    }
                })
        })


</script>