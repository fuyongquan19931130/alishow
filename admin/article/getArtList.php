<?php  
// print_r($_POST['pageno']);
// print_r($_POST['pagesize']);
// 1.获取前端传递的pageno和pagesize值
$pageno = $_POST['pageno'];
$pagesize = $_POST['pagesize'];
$start = ($pageno - 1) * $pagesize;
// 引入mysqli语句
include_once '../include/mysqli.php';

// 2.编写SQL语句并执行查询结果(三个表联合查询)
$sql = "select art.*, a.admin_nickname, c.cate_name from ali_article art
      join ali_admin a on art.article_adminid = a.admin_id
      join ali_cate c on art.article_cateid = c.cate_id
      limit $start, $pagesize";
$result_obj = mysqli_query($conn, $sql);
$arr = array();
while ($row = mysqli_fetch_assoc($result_obj)) {
	$arr[] = $row;
}
echo json_encode($arr);
?>