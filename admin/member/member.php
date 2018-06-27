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
  <script src="/assets/vendors/template/template-web.js"></script>
</head>
<body>
  <?php include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input class="btn btn-primary" type="button" value="添加新管理员" id="addadmin_btn">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/layer/layer.js"></script>
  <script type="text/template" id="tpl">
    <% for(i = 0; i < list.length; i++) { %>
      <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>
        <td><%=list[i].member_email%></td>
        <td><%=list[i].member_slug%></td>
        <td><%=list[i].member_nickname%></td>
        <td><%=list[i].member_state%></td>
        <td class="text-center">
          <a href="javascript:;"  x-data="<%=list[i].member_id%>" class="btn edit btn-default btn-xs">编辑</a>
          <a href="javascript:;" x-data="<%=list[i].member_id%>" class="btn del btn-danger btn-xs">删除</a>
        </td>
      </tr>
    <% } %>
  </script>
  <script>
    ////添加操作
    $.post('getMemberList.php', function (msg) {
      // alert(msg);
      // 将返回的json字符串转换成json对象
      var $json_obj = {"list": msg};
      // console.log($json_obj);
      var html = template('tpl', $json_obj);
      // console.log(html);
      $('tbody').html(html);
    }, 'json');
    $('#addadmin_btn').click(function () {
      layer.ready(function () {
        layer.open({
          type: 2,
          title: '添加新会员',
          maxmin: true,
          area: ['800px', '500px'],
          content: 'addadmin.php'
        });
      });
    });

    ////删除操作
    // 1.获取所有删除按钮，绑定点击事件--事件委托
    $('tbody').on('click', '.del', function () {
      var id = $(this).attr('x-data');
      // alert(id);
      var _this = $(this);
      layer.confirm('您确定删除该用户吗?', function () {
        $.get('deladmin.php', {"id": id, "_": Math.random()}, function (msg) {
          // alert(msg);
          if (msg == 1) {
            layer.alert('删除成功', function (index) {
              _this.parents('tr').remove();
              layer.close(index);
            });
          } else {
            layer.alert('删除失败');
          }
        });
      });
    });

    //// 修改操作
    // 1.获取页面上所有的编辑按钮，并添加点击事件
    $('tbody').on('click', '.edit', function () {
      var id = $(this).attr('x-data');
      layer.ready(function () {
        layer.open({
          type: 2,
          title: '编辑管理员信息',
          maxmin: true,
          area: ['800px', '500px'],
          content: 'editadmin.php?id=' + id
        });
      });
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>
