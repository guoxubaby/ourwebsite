<?php
$tempDir = $_FILES["uploadFile"]["tmp_name"];//temp目录下的文件完整路径
//查找数据库，搜索目前最大id
$connection = mysql_connect("localhost","root","");
mysql_select_db("projects",$connection);
$sql = "select max(id) as num from project_complete";
$result = mysql_query($sql,$connection);
$num = mysql_fetch_array($result)["num"];
$num = $num+1;

$newName = $num.".rar";//生成新的文件名
copy($tempDir, "project_file/".$newName);
unlink($tempDir);//删除temp目录下的文件
?>
<!--以下代码会写入前端代码的iframe元素中，相当于主页面的一个子页面-->
<!--通过跨域的jquery选择器，操作主页面的元素，以此达到类似于ajax的异步上传效果-->
<script src="js/jquery-2.1.1.min.js"></script><!--一定也要引入jq库-->
<script>
    alert("上传成功");
</script>
