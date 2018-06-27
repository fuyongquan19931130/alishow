<?php  
header('Content-type:text/html;charset=utf-8');
session_start();
session_destroy();
echo "退出登录成功";
header('refresh:1;url=/admin/login.html');
?>