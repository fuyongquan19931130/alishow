<?php  

$site_name = $_POST['site_name'];
$site_desc = $_POST['site_description'];
$site_keys = $_POST['site_keywords'];

$comment_status = isset($_POST['comment_status'] ? 1 : 2);
$comment_reviewed = isset($_POST['comment_reviewed'] ? 1 : 2);

$str = "<?php
	return array(
	'site_logo' => '../upload/1.jpg',
    'site_name' => '$site_name',
    'site_desc' => '$site_desc',
    'site_keys' => '$dite_keys',
    'site_cmt'  => $comment_status,
    'site_sh'   => $comment_reviewed
);
 ?>";

 file_put_contents('./site_conf.php', $str);

?>
