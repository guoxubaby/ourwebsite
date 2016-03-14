<?php
function ajaxJSON($state, $info = "", $data = null){
    echo json_encode(array("success" => $state, "info" => $info, "data" => $data));
}
$project_name = $_POST["project_name"];
$brief = $_POST["brief"];
$tel = $_POST["tel"];
$connection = mysql_connect("localhost","root","");
if($connection){
    mysql_select_db("projects",$connection);
    mysql_query("set names utf8");
    $sql = "insert into project_complete(project_name, brief, tel) values('$project_name','$brief','$tel')";
    mysql_query($sql,$connection);
    mysql_close($connection);
    ajaxJSON(true,"success", 0);
} else{
    ajaxJSON(false,"fail", 0);
}
