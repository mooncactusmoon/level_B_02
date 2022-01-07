<?php

include_once "../base.php";

$news=$News->find($_POST['news']);
// $news=$_POST['news'];
$type=$_POST['type'];

switch($type){
    case 1:
        //收回讚
        $Log->del(['news'=>$news['id'],'user'=>$_SESSION['login']]);
        // $Log->del(['news'=>$news,'user'=>$_SESSION['login']]);
        // $post=$News->find($news);
        $news['good']--;
        $News->save($news);
    break;
    case 2:
        //按讚
        $Log->save(['news'=>$news['id'],'user'=>$_SESSION['login']]);
        // $Log->save(['news'=>$news,'user'=>$_SESSION['login']]);
        // $post=$News->find($news);
        $news['good']++;
        $News->save($news);
    break;
}

?>