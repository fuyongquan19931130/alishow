<?php  
// print_r($_POST);
// print_r($_FILES);

// 处理上传文件
// 1.重命名
$pos = strrpos($_FILES['image']['name'], '.');
$ext = substr($_FILES['image']['name'], $pos);
$new_file = time().rand(1000, 9999).$ext;
// 定义上传的路径
$path = '../upload/'.$new_file;
// 2.移动文件
move_uploaded_file($_FILES['image']['tmp_name'], $path);


// 1.接收前端传过来的数据
$text = $_POST['text'];
$link = $_POST['link'];
// 2.引入mysqli.php文件
include_once '../include/mysqli.php';
// 3.编写SQL语句执行添加操作
$sql = "insert into ali_pic values(null, '$path', '$text', '$link')";
$result_bool = mysqli_query($conn, $sql);
// 4.判断并返回结果
if ($result_bool) {
	echo $path;
	/*$sql = "select * from ali_pic order by desc limit 0, 1";
	$result_obj = mysqli_query($conn, $sql);
	if (empty($result_obj)) {
		echo json_encode($result_obj);
	} else {
		echo 1;
	}*/
} else {
	echo 2;
}
?>