<?php

include_once "../base.php";

$chk=$User->math('count','id',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);

if($chk){
    echo 1;
    $_SESSION['user']=$_POST['acc'];

}else{
    echo 0;
}