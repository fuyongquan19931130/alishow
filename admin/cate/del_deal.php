<?php 
include_once '../include/checksession.php'; 
header('Content-type:text/html;charset=utf-8');
// 1.接收返回的id值和state值
$id    = $_GET['id'];
$state = $_GET['state'];

// 2.编写SQL语句执行更改数据操作
$sql = "update ali_cate set cate_state=$state where cate_id=$id";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);

// 3.判断
if($result_bool) {
	echo "修改状态成功";
} else {
	echo "修改状态失败";
}
header('refresh:1;url=categories.php');
?>