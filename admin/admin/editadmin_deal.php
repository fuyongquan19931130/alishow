<?php  
include_once '../include/checksession.php';
// 1.接收传过来的值
$id = $_POST['id'];
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$state = $_POST['state'];

// 2.编写SQL语句执行添加操作
$sql = "update ali_admin set admin_email='$email', admin_slug='$slug', admin_nickname='$nickname', admin_state='$state' where admin_id=$id";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);

// 3.判断结果
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
?>