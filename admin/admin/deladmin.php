<?php  
include_once '../include/checksession.php';
// 1.接收get传来的id
$id = $_GET['id'];
// echo $id;

// 2.编写SQL语句执行删除操作
$sql = "delete from ali_admin where admin_id=$id";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);

// 3.判断结果
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
?>