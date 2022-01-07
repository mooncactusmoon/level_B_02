<fieldset>
    <legend>目前位置: 首頁 > 最新文章區</legend>
    <table>
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td></td>
        </tr>
        <?php
        $total = $News->math("count", "*");
        $div = 5; //一頁幾個
        $pages = ceil($total / $div); //要有幾頁
        $now = $_GET['p'] ?? 1; //預設從第一頁開始
        $start = ($now - 1) * $div; //每一頁從誰開始

        $rows = $News->all(['sh' => 1], " limit $start,$div");
        foreach ($rows as $key => $row) {
        ?>
            <tr>
                <td class="clo switch">
                    <?= $row['title']; ?>
                </td>
                <td class="switch">
                    <div class="short"><?= mb_substr($row['text'], 0, 20); ?>...</div>
                    <div class="full" style="display:none;"><?= nl2br($row['text']); ?></div>
                </td>
                <td></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div>
    <?php
    if(($now-1)>0){
        $prev=$now-1;
        echo "<a href='index.php?do=news&p=$prev'>";
        echo "<";
        echo "</a>";
    }
    for($i=1;$i<=$pages;$i++){
        $font=($now==$i)?'24px':'16px';
        echo "<a href='index.php?do=news&p=$i' style='font-size:$font'>";
        echo $i;
        echo "</a>";
    }
    if(($now-1)<=$pages){
        $next=$now+1;
        echo "<a href='index.php?do=news&p=$next'>";
        echo ">";
        echo "</a>";
    }
    ?>
    </div>
</fieldset>
<script>
    $(".switch").on("click",function(){
        // $(this).parent().find(".short").toggle();
        // $(this).parent().find(".full").toggle();
        $(this).parent().find(".short,.full").toggle();
    })

</script>