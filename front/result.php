<?php
$subject = $Que->find($_GET['id']);
?>
<fieldset>
    <legend>目前位置:首頁 >問卷調查><?= $subject['text']; ?> </legend>
    <h3><?= $subject['text']; ?></h3>
    
        <?php
        $options = $Que->all(['parent' => $subject['id']]); //$subject['id'] = $_GET['id']
        foreach ($options as $key => $opt) {
            $div=($subject['count']==0)?1:$subject['count'];//分母判斷 分母不能為0
            $rate=round($opt['count']/$div,2); //比例
        ?>
        <div style="display:flex;margin:15px 0;">
            <div style="width:40%">
                <?=($key+1).".".$opt['text'];?>
            </div>
            <div style="height:25px;background:#ccc;width:<?=40*$rate?>%;">
            </div>
            <div><?=$opt['count'];?>票(<?=$rate*100;?>%)</div>
        </div>
        <?php
        }
        ?>
        <div class="ct">
           <!-- <a href="?do=que"><button>返回</button></a>  -->
           <button onclick="location.href='?do=que'">返回</button>
        </div>
   

</fieldset>