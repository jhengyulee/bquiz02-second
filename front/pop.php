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
                <td>
                    <span class="summary"><?=mb_substr($row['text'],0,20);?></span>
                    <div class="modal"><?=nl2br($row['text']);?></div>
                </td>
                <td></td>
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
                echo "<a href='?do=news&p={$i}' style='font-size:{$fontsize}'> $i </a>";
            }

            if(($now+1)<=$pages){
                $p=$now+1;
                echo "<a href='?do=news&p={$p}'> > </a>";
            }
        ?>
    </div>
</fieldset>