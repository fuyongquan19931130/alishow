<?php
// 1.获取前端传过来的ids值  
$ids = $_POST['ids'];
// echo $ids;

// 2.引入mysqli.php并编写SQL语句执行删除操作
include_once '../include/mysqli.php';
$sql = "delete from ali_article where article_id in ($ids)";
$result_bool = mysqli_query($conn, $sql);

// 3.判断并返回结果
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
?>