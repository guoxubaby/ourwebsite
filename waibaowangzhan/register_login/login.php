<?php
function ajaxJSON($state, $info = "", $data = null){
    echo json_encode(array("success" => $state, "info" => $info, "data" => $data));
}
$tel = $_POST["tel"];
$pwd = $_POST["pwd"];
$connection = mysql_connect("localhost","root","");

if($connection){
    mysql_select_db("projects",$connection);
    $sql = "select * from user where tel = '$tel'";
    $result = mysql_query($sql,$connection);
    if( $row = mysql_fetch_array($result) ){
        if( $pwd == $row['password'] ){
            ajaxJSON(true,"success",0);
        } else{
            ajaxJSON( false, "wrong password!", 0 );
        }
    } else{
        ajaxJSON( false, "user not exists!", 0 );

    }
}
mysql_close($connection);//要在最后关闭数据库

