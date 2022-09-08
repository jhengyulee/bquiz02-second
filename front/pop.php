<fieldset>
    <legend>目前位置:首頁 > 人氣文章區</legend>
    <table id="popular">
        <tr class='ct'>
            <td width='35%'>標題</td>
            <td width='35%'>內容</td>
            <td>人氣</td>
        </tr>

        <?php
            $all=$News->math('count','id',['sh'=>1]);
            $div=4;
            $pages=ceil($all/$div);
            $now=$_GET['p']??1;
            $start=($now-1)*$div;
            //分頁結束
            $rows=$News->all(['sh'=>1]," limit $start,$div");
            foreach($rows as $row){
        ?>
            <tr>
                <td class="clo title" style="cursor:pointer"><?=$row['title'];?></td>
                <td class="pop">
                    <span class="summary"><?=mb_substr($row['text'],0,20);?>...</span>
                    <div class="modal"><?=nl2br($row['text']);?></div>
                </td>
                <td class="ct">
                    <span><?php print($row['good']) ;?></span>個人說<img src="./icon/02B03.jpg" style="width:25px">
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
            </tr>
        <?php
            }
        ?>
        </tr>
    </table>

    <div class="ct">
        <?php
            if(($now-1)>0){
                $p=$now-1;
                echo "<a href='?do=news&p={$p}'> < </a>";  
            }

            for($i=1;$i<=$pages;$i++){
                $fontsize=($now==$i)?'24px':'16px';
                echo "<a href='?do=pop&p={$i}' style='font-size:{$fontsize}'> $i </a>";
            }

            if(($now+1)<=$pages){
                $p=$now+1;
                echo "<a href='?do=pop&p={$p}'> > </a>";
            }
        ?>
    </div>
</fieldset>

<script>
    $('.title').hover(
     function (){
         // console.log($(this).parent()); 
         $(this).next().find('.modal').show();
        },
    function (){
         // console.log($(this).parent()); 
         $(this).next().find('.modal').hide();
        }

    )

    $(".great").on("click",function(){
        let type=$(this).text(); //讚or收回讚
        let num=parseInt($(this).siblings('span').text());
        let id=$(this).data('id');
        $.post('./api/good.php',{type,id},()=>{
            if(type==='讚'){
                $(this).text('收回讚')
                $(this).siblings('span').text(num+1)
            }else{
                $(this).text('讚')
                $(this).siblings('span').text(num-1)
            }
        })
    })
</script>