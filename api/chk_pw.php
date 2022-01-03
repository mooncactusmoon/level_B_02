<?php
include_once "../base.php";
$acc=$_POST['acc'];
$pw=$_POST['pw'];

$chk=$User->math('count','*',['acc'=>$acc,'pw'=>$pw]);

// echo ($chk>0)?1:0;

if($chk>0){
    echo 1; //正確
    $_SESSION['login']=$acc;
}else{
    echo 0; //錯誤
}


?>