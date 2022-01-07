<fieldset>
    <legend>目前位置: 首頁 > 人氣文章區</legend>
    <table>
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td>人氣</td>
        </tr>
        <?php
        $total = $News->math("count", "*");
        $div = 5; //一頁幾個
        $pages = ceil($total / $div); //要有幾頁
        $now = $_GET['p'] ?? 1; //預設從第一頁開始
        $start = ($now - 1) * $div; //每一頁從誰開始

        $rows = $News->all(['sh' => 1], " order by `good` desc limit $start,$div");
        foreach ($rows as $key => $row) {
        ?>
            <tr>
                <td class="clo switch">
                    <?= $row['title']; ?>
                </td>
                <td class="switch">
                    <div class="short"><?= mb_substr($row['text'], 0, 20); ?>...</div>
                    <div class="full pop" style="display:none;">
                        <h2 style="color:skyblue;">
                            <?php
                                $tarray=[
                                    "1"=>"健康新知",
                                    "2"=>"菸害防治",
                                    "3"=>"癌症防治",
                                    "4"=>"慢性病防治",
                                ];
                                echo $tarray[$row['type']]; //陣列寫法

                            // //    switch寫法
                            // switch ($row['type']) {
                            //     case 1:
                            //         echo "健康新知";
                            //     break;
                            //     case 2:
                            //         echo "菸害防治";
                            //     break;
                            //     case 3:
                            //         echo "癌症防治";
                            //     break;
                            //     case 4:
                            //         echo "慢性病防治";
                            //     break;
                            // }
                            ?>
                        </h2>
                        <?= nl2br($row['text']); ?>
                    </div>
                </td>
                <td><?= $row['good']; ?>個人說<img src="icon/02B03.jpg" width="25px" height="25px"></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div>
        <?php
        if (($now - 1) > 0) {
            $prev = $now - 1;
            echo "<a href='index.php?do=pop&p=$prev'>";
            echo "<";
            echo "</a>";
        }
        for ($i = 1; $i <= $pages; $i++) {
            $font = ($now == $i) ? '24px' : '16px';
            echo "<a href='index.php?do=pop&p=$i' style='font-size:$font'>";
            echo $i;
            echo "</a>";
        }
        if (($now - 1) <= $pages) {
            $next = $now + 1;
            echo "<a href='index.php?do=pop&p=$next'>";
            echo ">";
            echo "</a>";
        }
        ?>
    </div>
</fieldset>
<script>
    $(".switch").hover(
        function() {
            // $(this).parent().find(".full").addClass('pop').toggle();
            $(this).parent().find(".pop").toggle();
        })
</script>