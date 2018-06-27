<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>
  <?php  
	// echo $_GET['id'];
	// 1.获取传过来的id值
	$id = $_GET['id'];

	// 2.编写SQL语句执行查询操作
	$sql = "select * from ali_admin where admin_id=$id";
	include_once '../include/mysqli.php';
	$result_obj = mysqli_query($conn, $sql);
	$admin_info = mysqli_fetch_assoc($result_obj);
	?>
  <div class="col-md-4">
    <form id="mainForm">
      <h2>修改用户信息</h2>
      <div>
        <input name="id" type="hidden" value="<?php echo $admin_info['admin_id']; ?>">
      </div>
      <div class="form-group">
        <label for="email">邮箱</label>
        <input id="email" class="form-control" name="email" type="email" value="<?php echo $admin_info['admin_email']; ?>">
      </div>
      <div class="form-group">
        <label for="slug">别名</label>
        <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $admin_info['admin_slug']; ?>">
      </div>
      <div class="form-group">
        <label for="nickname">昵称</label>
        <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $admin_info['admin_nickname']; ?>">
      </div>
      <div class="form-group">
        <label for="state">状态</label>
        <?php if ($admin_info['admin_state'] == '激活') { ?>
        <input name="state" type="radio" value="激活" checked>激活
        <input name="state" type="radio" value="禁用">禁用
        <?php } else { ?>
        <input name="state" type="radio" value="激活">激活
        <input name="state" type="radio" value="禁用" checked>禁用
        <?php } ?>
      </div>
      <div class="form-group">
        <input class="btn btn-primary" type="button" value="修改">
      </div>
    </form>
  </div>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>
  	$('.btn-primary').click(function () {
  		var fm = $('#mainForm')[0];
  		var fd = new FormData(fm);
  		$.ajax({
  			url: 'editadmin_deal.php',
  			data: fd,
  			type: 'post',
  			dataType: 'text',
  			contentType: false,
  			processData: false,
  			success: function (msg) {
  				// alert(msg);
  				if (msg == 1) {
  					parent.layer.alert('修改信息成功', function () {
  						var index = parent.layer.getFrameIndex(window.nam);
  						parent.layer.close(index);
  						parent.location.reload();
  					});
  				} else {
  					parent.layer.alert('修改信息失败');
  				}
  			}
  		});
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>