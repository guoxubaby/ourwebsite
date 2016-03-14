<?php
    function ajaxJSON($state, $info = "", $data = null){
        echo json_encode(array("success" => $state, "info" => $info, "data" => $data));
    }

    $page = $_POST["page"];//当前页码
    $query = $_POST["query"];//查询主体（可以替换为其他查询语句）
    $queryCount = $_POST["queryCount"];
    $db = $_POST["db"];


    $divide = 10;//用于控制每页显示条数
    $begin = ($page-1)*10;//sql语句中 limit字句的起始

    //数据库的相关操作
    $connection = mysql_connect("localhost","root","");//连接数据库系统
    if($connection){
        mysql_select_db($db,$connection);//选择数据库
		mysql_query("set names utf8");
        $limit = " limit ".$begin.", ".$divide;//limit子句
        $sql = $query.$limit;//完整的sql语句

        //查询
        $result = mysql_query($sql,$connection);
        $result_arr = array();
        while($row = mysql_fetch_array($result)){
            array_push($result_arr,$row);
        }

        $row_num = mysql_fetch_array(mysql_query($queryCount,$connection));
        $pageNum = ceil($row_num['num']/$divide);//查询总共的结果有多少页
        //返回结果
        ajaxJSON(true,$pageNum, $result_arr);
    } else{
        ajaxJSON(false,"fail", 0);
    }