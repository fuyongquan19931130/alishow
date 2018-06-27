<?php  
// print_r($_POST);

// 1.获取传过来的值
session_start();
$id = $_SESSION['id'];
$newpwd = md5($_POST['newpwd']);
$oldpwd = md5($_POST['oldpwd']);
$re_newpwd = md5($_POST['re_newpwd']);
// 判断旧密码和新密码是否相等
if ($newpwd == $oldpwd) {
	// 如果相等，直接返回1
	echo 1;
	die();
} else {
	// 2.编写SQL语句执行查询操作
	$sql = "select * from ali_admin where admin_id='$id'";
	include_once './include/mysqli.php';
	$result_obj = mysqli_query($conn, $sql);
	// 3.判断并返回结果
	$admin_info = mysqli_fetch_assoc($result_obj);
	if ($oldpwd == $admin_info['admin_pwd']) {
		if($newpwd == $re_newpwd) {
			// 4.编写SQL语句执行修改操作
			$sql_a = "update ali_admin set admin_pwd='$newpwd' where admin_id='$id'";
			$result_bool = mysqli_query($conn, $sql_a);
			if ($result_bool) {
				echo 4;
				// header('refresh:1;url=./profile.php');
			} else {
				echo 5;
			}
		} else {
			echo 3;
		}
	} else {
		echo 2;
	}
}
?>