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
  <div class="col-md-4">
    <form id="mainForm">
      <h2>添加新用户</h2>
      <div class="form-group">
        <label for="email">邮箱</label>
        <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
      </div>
      <div class="form-group">
        <label for="slug">别名</label>
        <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
      </div>
      <div class="form-group">
        <label for="nickname">昵称</label>
        <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
      </div>
      <div class="form-group">
        <label for="pwd">密码</label>
        <input id="pwd" class="form-control" name="pwd" type="text" placeholder="密码">
      </div>
      <div class="form-group">
        <label for="state">状态</label>
        <input name="state" type="radio" value="激活">激活
        <input name="state" type="radio" value="禁用">禁用
      </div>
      <div class="form-group">
        <input class="btn btn-primary" type="button" value="添加">
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
  			url: 'addadmin_deal.php',
  			data: fd,
  			type: 'post',
  			dataType: 'text',
  			contentType: false,
  			processData: false,
  			success: function (msg) {
  				// alert(msg);
  				if (msg == 1) {
  					parent.layer.alert('添加成功', function () {
  						var index = parent.layer.getFrameIndex(window.name);
  						parent.layer.close(index);
  						parent.location.reload();
  						/*var str = "<tr>";
  						str += '<td class="text-center"><input type="checkbox"></td>';
        			str += '<td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>';
  						str += "<td>" + email.value + "</td>";
  						str += "<td>" + slug.value + "</td>";
  						str += "<td>" + nickname.value + "</td>";
  						str += "<td>" + state.value + "</td>";
  						str += '<td class="text-center">'
						          '<a href="javascript:;" class="btn btn-default btn-xs">编辑</a>'
						          '<a href="javascript:;" class="btn del btn-danger btn-xs">删除</a>'
						        '</td>';
  						str += "</tr>";
  						var abc = str.innerHTML;
  						console.log(abc);
  						// $('tbody').appendChild(abc);*/
  					});
  				} else {
  					parent.layer.alert('添加失败');
  				}
  			}
  		});
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>
