<?php  
// print_r($_FILES);
// 1.重命名文件
$pos = strrpos($_FILES['f']['name'], '.');
$ext = substr($_FILES['f']['name'], $pos);
$new_file = time().rand(10000, 99999).$ext;
// 保存到数据表中的路径
$path = '../upload/'.$new_file;
// 将文件从临时路径移动到指定路径
$result_file = move_uploaded_file($_FILES['f']['tmp_name'], $path);
if ($result_file) {
	echo $path;
} else {
	echo 2;
}
?>