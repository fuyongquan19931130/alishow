<?php  
include_once '../include/checksession.php';
// 1.引入mysqli.php文件
include_once '../include/mysqli.php';

// 2.编写SQL语句执行查询操作
$sql = "select * from ali_admin";
$result_obj = mysqli_query($conn, $sql);

// 3.将得到的结果(对象)转化为数组
$arr = array();
while($row = mysqli_fetch_assoc($result_obj)) {
	$arr[] = $row;
}

// 4.将数组转化为json字符串
echo json_encode($arr);
?>