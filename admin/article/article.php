<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
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
        <h1>所有文章</h1>
        <a href="javascript:;" class="btn btn-primary btn-xs" id="write_art">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger dels btn-sm" href="javascript:;">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right" id="pagination">
         
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
  <script src="/assets/vendors/template/template-web.js"></script>
  <script type="text/template" id="tpl">
    <% for (i = 0; i < list.length; i++) { %>
      <tr>
        <td class="text-center"><input type="checkbox" value="<%=list[i].article_id%>"></td>
        <td><%=list[i]['article_title']%></td>
        <td><%=list[i]['admin_nickname']%></td>
        <td><%=list[i]['cate_name']%></td>
        <td class="text-center"><%=list[i]['article_addtime']%></td>
        <td class="text-center"><%=list[i]['article_state']%></td>
        <td class="text-center">
          <a href="javascript:;" x-data="<%=list[i]['article_id']%>" class="btn btn-default btn-xs">编辑</a>
          <a href="javascript:;" x-data="<%=list[i]['article_id']%>" class="btn btn-danger del btn-xs">删除</a>
        </td>
      </tr>
    <% } %>
  </script>
<?php 
// 1.引入mysqli.php
include_once '../include/mysqli.php'; 
// 手动定义每页显示的article条数
$pagesize = 5;
// 2.编写SQL语句并执行查询结果
$sql = "select count(*) num from ali_article";
$result_obj = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result_obj);
// 找出ali_article数据表中的数据总数
$num = $row['num'];
// echo $num;
// 3.计算出总页数
$totalPages = ceil($num / $pagesize);
// echo $totalPages;
// echo $pagesize;
?>
  <script>
    /// 引入分页导航栏插件
    $('#pagination').twbsPagination({
      totalPages: <?php echo $totalPages; ?>,
      visiblePages: 5,
      first: '首页',
      prev: '上一页',
      next: '下一页',
      last: '尾页',
      onPageClick: function (event, page) {
        // console.log(page + '(from options)');
        $.post('getArtList.php', {'pageno': page, 'pagesize': <?php echo $pagesize; ?>}, function (msg) {
          // console.log(msg);
          var $json_obj = {"list": msg};
          // 模板引擎渲染
          var html = template('tpl', $json_obj);
          $('tbody').html(html);
        }, 'json');
      }
    });

    /// 点击写文章，跳转页面
    document.getElementById('write_art').onclick = function () {
      location.href = 'addarticle.php';
    }

    /// 批量删除文章操作
    $('.dels').click(function () {
      var check_list = $(':checkbox:checked');
      // console.log(check_list);
      var str = '';
      check_list.each(function (index, elem) {
        str += elem.value + ',';
      });
      // 截取掉str中的最后一段
      str = str.slice(0, -1);
      // console.log(str);
      $.post('delsarticle.php', {"ids": str}, function (msg) {
        // alert(msg);
        if (msg == 2) {
          alert('批量删除失败');
        } else {
          alert('批量删除成功');
          location.reload();
        }
      });
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>