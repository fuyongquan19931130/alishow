<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
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
// 1.引入mysqli.php文件 
include_once '../include/mysqli.php';

// 2.编写SQL语句执行查询操作
$sql = "select * from ali_pic";
$result_obj = mysqli_query($conn, $sql);

// 3.将获得到的数据填写到表格中
?>
  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="mainForm">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="button" value="添加">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="slide" src="<?php echo $row['pic_url']; ?>"></td>
                <td><?php echo $row['pic_text']; ?></td>
                <td><?php echo $row['pic_link']; ?></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php } ?>
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
  <script src="/assets/vendors/template/template-web.js"></script>
  <script type="text/template" id="tpl">
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td class="text-center"><img class="slide" src="<%=url%>"></td>
      <td><%=text%></td>
      <td><%=link%></td>
      <td class="text-center">
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  </script>
  <script>
    $('.btn-primary').click(function () {
      var fm = $('#mainForm')[0];
      var fd = new FormData(fm);
      $.ajax({
        url: 'addpic.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          // console.log(msg)
          if (msg == 2) {
            alert('添加轮播图失败');
          } else {
            alert('添加轮播图成功');
            var json_obj = {
              "url": msg,
              "text": $('#text').val(),
              "link": $('#link').val()
            };
            var html = template('tpl', json_obj);
            $('tbody').append(html);
          }
        }
      });
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>
