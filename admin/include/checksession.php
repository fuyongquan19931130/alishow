<?php  
session_start();
// 验证是否存在名叫id的session
if (empty($_SESSION['id'])) {
	// 如果不存在，说明未登录，并跳转到登录页面
	echo '您尚未登录，请登录后再访问';
	// header中的URL地址也可以使用绝对路径
	header('refresh:1;url=/admin/login.html');
	die();
}
?>