<?php  
include_once '../include/mysqli.php';
$sql = "select * from ali_cate where cate_state=1";
$result_obj = mysqli_query($conn, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result_obj)) {
  $arr[] = $row;
}
echo json_encode($arr);
?>