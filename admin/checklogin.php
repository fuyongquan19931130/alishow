<?php 
// 1.接收传过来的数据 
$email = $_POST['email'];
$pwd = md5($_POST['pwd']);

// 2.编写SQL语句并执行查询操作
$sql = "select * from ali_admin where admin_email='$email'";
include_once './include/mysqli.php';
$result_obj = mysqli_query($conn, $sql);
$admin_info = mysqli_fetch_assoc($result_obj);

// 3.判断并返回结果
if (empty($admin_info)) {
	echo 1;
} else {
	if ($pwd == $admin_info['admin_pwd']) {
		echo 2;
		session_start();
		$_SESSION['id']       = $admin_info['admin_id'];
		$_SESSION['email']    = $admin_info['admin_email'];
		$_SESSION['nickname'] = $admin_info['admin_nickname'];
		$_SESSION['pic'] = $admin_info['admin_pic'];
	} else {
		echo 3;
	}
}
?>