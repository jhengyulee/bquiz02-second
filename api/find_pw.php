<?php


include_once "../base.php";

$pw=$User->find(['email'=>$_POST['email']]);

echo (!empty($pw))?'您的密碼為:'.$pw['pw']:'查無資料';