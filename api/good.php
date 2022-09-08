<?php
include_once "../base.php";

$id=$_POST['id'];
$type=$_POST['type'];

$news=$News->find($id);

switch($type){
    case "讚":
        $news['good']++;
        $Log->save(['news'=>$id,'user'=>$_SESSION['user']]);
        break;

    case "收回讚":
        $news['good']--;
        $Log->del(['news'=>$id,'user'=>$_SESSION['user']]);
        break;
}

$News->save($news);