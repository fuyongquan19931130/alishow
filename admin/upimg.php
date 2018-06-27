<?php  
// print_r($_FILES);
// 1.重命名文件
$pos = strrpos($_FILES['f']['name'], '.');
$ext = substr($_FILES['f']['name'], $pos);
$new_file = time().rand(10000, 99999).$ext;
// 保存到数据表中的路径
$path = '../upload/' . $new_file;
// 将文件从临时路径移动到指定路径
$file_result = move_uploaded_file($_FILES['f']['tmp_name'], './upload/' . $new_file);
// 2.将新文件的路径保存到数据表中
session_start();
$id = $_SESSION['id'];
// 编写SQL语句并执行修改操作
$sql = "update ali_admin set admin_pic='$path' where admin_id='$id'";
include_once './include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);
// 3.判断并返回结果
if ($file_result) {
	echo $path;
} else {
	echo 2;
}
?>