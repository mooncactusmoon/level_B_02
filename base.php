<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web02";
    protected $user="root";
    protected $pw="";
    protected $pdo;
    public $table;
    public $title;
    public $button;
    public $header; //表單的第一個框框col
    public $append; //只有admin和menu會用到
    public $upload;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
        

    }

    

    // 找一筆資料
    public function find($id){
        $sql="SELECT * FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    // 找一筆資料end

    // 找全部資料
    public function all(...$arg){
        $sql="SELECT * FROM $this->table ";
        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .=" WHERE ".implode(" AND ",$tmp)." ".$arg[1];
            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ",$tmp);
                }else{
                    $sql .= $arg[0];   
                }
            break;
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // 找全部資料 end


    //計算資料(各種方式) count max min sum...
    public function math($method,$col,...$arg){
        $sql="SELECT $method($col) FROM $this->table ";

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ",$tmp)." ".$arg[1];
            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .=" WHERE ".implode(" AND ",$tmp);
                }else{

                    $sql .=$arg[0];

                }

            break;
        }

        return $this->pdo->query($sql)->fetchColumn(); //僅針對回傳一個資料的狀況
        
    }
    //計算資料(各種方式) end

    //新增跟更新資料
    public function save($array){
        //id有無判斷是更新還是新增
        if(isset($array['id'])){
            //update
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql="UPDATE $this->table SET ".implode(",",$tmp)." WHERE `id`='{$array['id']}'";
        
        }else{
            //insert
            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`) 
                                     VALUES('".implode("','",$array)."')";
        }

        
        return $this->pdo->exec($sql);
    }
    //新增跟更新資料 end

    //刪除資料
    public function del($id){
        $sql="DELETE FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }

        return $this->pdo->exec($sql);
    }
    //刪除資料 end


    //萬用查詢
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    //萬用查詢 end
    

}

function to($url){
    header("location:$url");
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$User=new DB('user');
$News=new DB('news');
$Log=new DB('log');
$Que=new DB('que');
$View=new DB('view');

/**
 * 先找到有沒有今日的瀏覽人數紀錄
 *  * 有 ->人次+1
 *  * 沒有 -> 增加今日的新紀錄 
 */
if(!isset($_SESSION['view'])){
    if($View->math('count','*',['date'=>date("Y-m-d")])>0){
        $view=$View->find(['date'=>date("Y-m-d")]);
        $view['total']+=1; // $view['total']++   $view['total']+1
        $View->save($view);
        $_SESSION['view']=$view['total'];
    }else{
        $View->save(['date'=>date("Y-m-d"),'total'=>1]);
        $_SESSION['view']=1;
    }
}

?>