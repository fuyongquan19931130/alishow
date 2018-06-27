<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php 
  include_once './include/checksession.php'; 
  session_start();
  $id = $_SESSION['id'];
  ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once './include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <!-- <input name="id" type="hidden" value="<?php echo $id; ?>"> -->
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" name="oldpwd" class="form-control" type="password" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" name="newpwd" class="form-control" type="password" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" name="re_newpwd" class="form-control" type="password" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <input type="button" class="btn btn-primary" value="修改密码">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>
    $('.btn-primary').click(function () {
      var fm = $('.form-horizontal')[0];
      var fd = new FormData(fm);
      // console.log(fd);
      $.ajax({
        url: 'checkpwd.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          // alert(msg);
          if (msg == 1) {
            alert('新密码不能和旧密码一样,请重新输入');
          } else if (msg == 2) {
            alert('旧密码输入错误,请重新输入');
          } else if (msg == 3) {
            alert('新密码与确认新密码输入不一致，请重新输入');
          } else if (msg == 4) {
            alert('修改密码成功');
            location.href = './profile.php';
          } else if (msg == 5) {
            alert('修改密码失败');
          }
        }
      });
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>
