<?php  
// print_r($_POST);
// 1.接收前端传送过来的数据
$id    = $_POST['id'];
$state = $_POST['state'];

// 2.引入mysqli.php文件
include_once '../include/mysqli.php';

// 3.编写SQL语句执行修改操作
if ($state = '批准') {
	$sql = "update ali_comment set cmt_state='已批准' where cmt_id='$id'";
} else {
	$sql = "update ali_comment set cmt_state='未批准' where cmt_id='$id'";
}
$result_bool = mysqli_query($conn, $sql);

// 4.判断并返回结果
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
?>