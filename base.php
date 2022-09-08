<?php
session_start();
date_default_timezone_set("Asia/Taipei");

class DB{
    protected $table;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db24_2";
    protected $pdo;

    function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    // all()
    function all(...$arg){
        $sql="select * from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $val){
                    $tmp[]="`$key`='$val'";
                }
                $sql.=" where ".join(" && ",$tmp);
            }else{
                $sql.=$arg[0];
            }
        }

        if(isset($arg[1])){
            $sql.=$arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // math()
    function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $val){
                    $tmp[]="`$key`='$val'";
                }
                $sql.=" where ".join(" && ",$tmp);
            }else{
                $sql.=$arg[0];
            }
        }

        if(isset($arg[1])){
            $sql.=$arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

    // find()
    function find($id){
        $sql="select * from $this->table where ";
        if(is_array($id)){
            foreach($id as $key => $val){
                $tmp[]="`$key`='$val'";
            }
            $sql.=join(" && ",$tmp);
        }else{
            $sql.=" `id` = '$id' ";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // del()
    function del($id){
        $sql="delete from $this->table where ";
        if(is_array($id)){
            foreach($id as $key => $val){
                $tmp[]="`$key`='$val'";
            }
            $sql.=join(" && ",$tmp);
        }else{
            $sql.=" `id` = '$id' ";
        }
        return $this->pdo->exec($sql);
    }

    // save()
    function save($array){
        if(isset($array['id'])){
            //更新
            foreach($array as $key => $val){
                $tmp[]="`$key`='$val'";
            }
            $sql="update $this->table set ".join(",",$tmp)." where id = '{$array['id']}'";

        }else{
            //新增
            $sql="insert into $this->table (`".join("`,`",array_keys($array))."`)
                                      values('".join("','",$array)."')";
        }
        return $this->pdo->exec($sql);
    }
}

// to()
function to($url){
    header('location:'.$url);
}

// dd()
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}



$Total=new DB('total');
$User=new DB('user');
$Que=new DB('que');
$News=new DB('news');
$Log=new DB('log');

if(!isset($_SESSION['total'])){
    $date=$Total->math('count','id',['date'=>date("Y-m-d")]);
    if($date>=1){
        $total=$Total->find(['date'=>date("Y-m-d")]);
        $total++;
        $Total->save($total);
        $_SESSION['total']=1;
    }else{
        $Total->save(['date'=>date("Y-m-d"),'total'=>1]);
        $_SESSION['total']=1;
    }
}