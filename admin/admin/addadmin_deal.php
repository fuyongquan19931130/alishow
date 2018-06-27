<?php  
include_once '../include/checksession.php';
// 1.接收前端传来的数据
$email = $_POST['email']; 
$slug = $_POST['slug']; 
$nickname = $_POST['nickname']; 
$pwd = md5($_POST['pwd']); 
$state = $_POST['state']; 
$addtime = date('Y-m-d', time());

// 2.编写SQL语句并执行添加操作
$sql = "insert into ali_admin(admin_id, admin_email, admin_slug, admin_nickname, admin_pwd, admin_state, admin_addtime) values(null, '$email', '$slug', '$nickname', '$pwd', '$state', '$addtime')";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);
// 3.判断结果
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
?>