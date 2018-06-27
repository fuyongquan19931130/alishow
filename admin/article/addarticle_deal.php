<?php  
// print_r($_POST);

// 1.接收前端传来的数据
$title    = $_POST['title'];
$desc     = $_POST['desc'];
$text     = $_POST['text'];
$file     = $_POST['file'];
$cateid = $_POST['category'];
$state    = $_POST['state'];

// 补充数据表所需的其他数据
session_start();
$adminid   = $_SESSION['id'];
$addtime  = date('Y-m-d H:i:s');
$click    = rand(200, 1000);
$good     = rand(200, 500);
$bad      = rand(50, 200);
$cmt      =	0;
// 2.引入mysqli语句
include_once '../include/mysqli.php';
$sql = "insert into ali_article values(null, '$title', '$text', $adminid, $cateid, $addtime, '$state', '$file', '$desc', '$click', '$good', '$bad', '$cmt')";
$result_bool = mysqli_query($conn, $sql);
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
?>