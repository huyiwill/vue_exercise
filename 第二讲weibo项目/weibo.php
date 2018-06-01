<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 14:13
 */
header('Access-Control-Allow-Origin:*');
//创建数据库
$db = @mysqli_connect('127.0.0.1', 'root', 'aa');
mysqli_query($db, "set names 'utf8'");
mysqli_select_db($db, 'vue');

//检查表是否存在
$sql = "select TABLE_NAME  from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='vue' and TABLE_NAME ='weibo'";
$res = mysqli_query($db, $sql);
if($res->num_rows == 0){
    $sql = <<<END
CREATE TABLE  `vue`.`weibo` (
`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`content` TEXT NOT NULL ,
`time` INT NOT NULL ,
`acc` INT NOT NULL ,
`ref` INT NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
    mysqli_query($db, $sql);
}

//定义打印方法
function p($a){
    echo "<pre>";
    print_r($a);
    die;
}

//业务逻辑开始
$act       = $_GET['act'];
$PAGE_SIZE = 6;

switch($act){
    case 'top':
        //赞
        $info = $_GET['info'];
        $id   = $info['id'];
        $sql  = "select acc from weibo where id='{$id}'";
        $res  = mysqli_query($db, $sql);
        $row  = mysqli_fetch_array($res);
        $acc  = $row['acc'] + 1;
        $sql  = "update weibo set acc={$acc} where id={$id}";
        $r    = mysqli_query($db, $sql);
        if($r){
            echo json_encode(array('error' => 0, 'acc' => $acc));
        }else{
            echo json_encode(array('error' => -1));
        }
        break;
    case 'down':
        //踩
        $info = $_GET['info'];
        $id   = $info['id'];
        $sql  = "select ref from weibo where id='{$id}'";
        $res  = mysqli_query($db, $sql);
        $row  = mysqli_fetch_array($res);
        $ref  = $row['ref'] + 1;
        $sql  = "update weibo set ref={$ref} where id={$id}";
        $r    = mysqli_query($db, $sql);
        if($r){
            echo json_encode(array('error' => 0, 'ref' => $ref));
        }else{
            echo json_encode(array('error' => -1));
        }
        break;
    case 'sel':  //模拟加载数据
        $sql = "select * from weibo order by id desc limit 10";
        $res = mysqli_query($db, $sql);
        $arr = array();
        while($row = mysqli_fetch_row($res)){
            $arr[$row[0]]['id']      = $row[0];
            $arr[$row[0]]['content'] = $row[1];
            $arr[$row[0]]['time']    = $row[2];
            $arr[$row[0]]['acc']     = $row[3];
            $arr[$row[0]]['ref']     = $row[4];
        }

        //$rows = mysqli_fetch_array($res);
        if(is_array($arr)){
            $data = array(
                'error' => 0,
                'info'  => array_merge($arr)
            );
            echo json_encode($data);
        }else{
            $data = array(
                'error' => -1,
                'info'  => '没有数据'
            );
            echo json_encode($data);
        }
        break;
    case 'get':
        //获取数据
        $page = $_GET['p'];
        if($page < 1){
            $page = 1;
        }
        $s      = ($page - 1) * $PAGE_SIZE;
        $sql    = "SELECT * FROM weibo ORDER BY id DESC LIMIT {$s}, {$PAGE_SIZE}";
        $res    = mysqli_query($db, $sql);
        $result = array();
        while($row = mysqli_fetch_array($res)){
            $result[$row[0]]['id']      = $row[0];
            $result[$row[0]]['content'] = $row[1];
            $result[$row[0]]['time']    = $row[2];
            $result[$row[0]]['acc']     = $row[3];
            $result[$row[0]]['ref']     = $row[4];
            //array_push($arr, '"id":' . $row[0]);
            //array_push($arr, '"content":' . $row[1]);
            //array_push($arr, '"time":' . $row[2]);
            //array_push($arr, '"acc":' . $row[3]);
            //array_push($arr, '"ref":' . $row[4]);
            //array_push($result,implode(',',$arr));
        }

        if(count($result) > 0){
            echo json_encode(array_merge($result));
        }else{
            echo json_encode(array());
        }
        break;
    case 'getpages':
        //获取页数
        $sql    = "select count(*) as c from weibo";
        $res    = mysqli_query($db, $sql);
        $pcount = mysqli_fetch_array($res);
        $pages  = ceil($pcount['c'] / $PAGE_SIZE);
        echo json_encode(array('error' => 0, 'pages' => $pages));
        break;
    case 'add':
        $con  = $_GET['content'];
        $con  = str_replace("\n", '', $con);
        $time = time();
        $sql  = "insert into weibo (ID, content, time, acc, ref) VALUES(0, '{$con}', {$time}, 0, 0)";
        $r    = mysqli_query($db, $sql);

        if($r){
            $res  = mysqli_query($db, 'SELECT LAST_INSERT_ID()');
            $row  = mysqli_fetch_array($res);
            $id   = (int) $row[0];
            $data = array(
                'error' => 0,
                'id'    => $id,
                'time'  => $time
            );
            echo json_encode($data);
        }else{
            $data = array(
                'error' => -1,
                'id'    => 0,
                'time'  => $time
            );
            echo json_encode($data);
        }
        break;
    case 'get_page_count':
        break;
    case 'del':
        $id   = $_GET['id'];
        $sql  = "delete from weibo where id='{$id}'";
        $r    = mysqli_query($db, $sql);
        $time = time();
        if($r){
            $data = array(
                'error' => 0,
                'time'  => $time
            );
            echo json_encode($data);
        }else{
            $data = array(
                'error' => -1,
                'time'  => $time
            );
            echo json_encode($data);
        }
        break;
}
