<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <link href="/assets/vendors/umediter/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="/assets/vendors/umediter/third-party/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/umediter/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/umediter/umeditor.min.js"></script>
  <script type="text/javascript" src="/assets/vendors/umediter/lang/zh-cn/zh-cn.js"></script>
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" id="mainForm">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="desc">描述</label>
            <textarea id="desc" class="form-control input-lg" name="desc" cols="30" rows="3" placeholder="描述" ></textarea>
          </div>
          <div class="form-group">
            <label for="text">文本内容</label>
            <textarea id="text" class="form-control input-lg" name="text" cols="30" rows="10" placeholder="文本内容" ></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="file">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="file" class="form-control" name="file" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <!-- <option value="1">未分类</option> -->
            </select>
          </div>
          <div class="form-group">
            <label for="addtime">发布时间</label>
            <input id="addtime" class="form-control" name="addtime" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="state">状态</label>
            <select id="state" class="form-control" name="state">
              <option value="草稿">草稿</option>
              <option value="已发布">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" value="添加">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/template/template-web.js"></script>
  <script type="text/template" id="tpl">
    <% for(i = 0; i < list.length; i++) { %>
      <option value="<%=list[i]['cate_id']%>"><%=list[i]['cate_name']%></option>
    <% } %>
  </script>
  <script>
    /// 在文本内容处引入富文本编辑器插件
    var um = UM.getEditor('text', {
             initialFrameWidth: '100%', //初始化编辑器宽度,默认500
             initialFrameHeight: 300,  //初始化编辑器高度,默认500
             initialContent: '文本内容',
             autoClearinitialContent:true
          });

    /// 获取数据库中的cate_name，并渲染到页面上
    $.post('getCateList.php', function (msg) {
      // console.log(msg);
      $json_obj = {"list": msg};
      // 引用模板引擎
      $html = template('tpl', $json_obj);
      $('#category').html($html);
    }, 'json');

    /// 文本上传操作
    // 1.文本域绑定change事件
    $('#file').change(function () {
      var fd = new FormData();
      var file_obj = $(this)[0].files[0];
      fd.append('f', file_obj);
      $.ajax({
        url: 'upimg.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          // console.log(msg);
          if (msg == 2) {
            alert('文件上传失败');
          } else {
            $('.thumbnail').attr({'style': 'display: block', 'src': msg});
          }
        }
      });
    });

    /// 获取页面上的添加按钮，并绑定点击事件
    $('.btn-primary').click(function () {
      var fm = $('#mainForm')[0];
      var fd = new FormData(fm);
      $.ajax({
        url: 'addarticle_deal.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          // alert(msg);
          if (msg == 2) {
            alert('添加新文章失败');
          } else {
            alert('添加新文章成功');
            location.href = 'article.php';
          }
        }
      });
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>