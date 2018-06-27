<?php 
include_once '../include/checksession.php'; 
header('Content-type:text/html;charset=utf-8');
// 1.接收返回的id值
$id      = $_POST['id'];
$name    = $_POST['name'];
$slug    = $_POST['slug'];
$icon    = $_POST['icon'];
$state   = $_POST['state'];
$show    = $_POST['show'];
$addtime = date('Y-m-d', time());

// 2.编写SQL语句进行修改操作
$sql = "update ali_cate set cate_name='$name', cate_slug='$slug', cate_addtime='$addtime', cate_icon='$icon', cate_state=$state, cate_show=$show where cate_id=$id";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);

// 3.判断
if($result_bool) {
	echo "栏目数据修改成功";
	header('refresh:1;url=categories.php');
} else {
	echo "栏目数据修改失败";
	header('refresh:1;url=editcate.php?id=$id');
}
?>