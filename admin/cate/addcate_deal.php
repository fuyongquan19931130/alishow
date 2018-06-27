<?php 
include_once '../include/checksession.php';
header('Content-type:text/html;charset=utf-8'); 
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
$time = date('Y-m-d', time());

$sql = "insert into ali_cate values(null, '$name', '$slug', '$time', '$icon', $state, $show)";

include_once '../include/mysqli.php';

$result_bool = mysqli_query($conn, $sql);

if($result_bool) {
	echo "添加新栏目成功";
	header('refresh:1;url=categories.php');
} else {
	echo "添加新栏目失败";
	header('refresh:1;url=addcate.php');
}
?>