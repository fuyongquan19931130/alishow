<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
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
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      	<?php  
		// 1.接收返回的id值
		$id = $_GET['id'];

		// 2.编写SQL语句执行查询操作
		$sql = "select * from ali_cate where cate_id=$id";
		include_once '../include/mysqli.php';
		$result_obj = mysqli_query($conn, $sql);
		// 3.将结果(对象)转化为一维数组
		$cate_info = mysqli_fetch_assoc($result_obj);
		// 4.将获得到的数据填入表格中
		?>
      <div class="row">
        <div class="col-md-4">
          <form action="editcate_deal.php" method="post">
            <h2>添加新分类目录</h2>
            <input type="hidden" name="id" value="<?php echo $cate_info['cate_id']; ?>">
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" value="<?php echo $cate_info['cate_name']; ?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $cate_info['cate_slug']; ?>">
            </div>
            <div class="form-group">
              <label for="icon">图标</label>
              <input id="icon" class="form-control" name="icon" type="text" value="<?php echo $cate_info['cate_icon']; ?>">
            </div>
            <div class="form-group">
              <label for="state">状态</label>
              <?php if($cate_info['cate_icon'] == 1) { ?>
              <input id="state" name="state" type="radio" value="1" checked>启用
              <input id="state" name="state" type="radio" value="2">禁用
              <?php } else { ?>
              <input id="state" name="state" type="radio" value="1">启用
              <input id="state" name="state" type="radio" value="2" checked>禁用
              <?php } ?>
            </div>
            <div class="form-group">
              <label for="show">是否显示</label>
              <?php if($cate_info['cate_show']== 1) { ?>
              <input id="show" name="show" type="radio" value="1" checked>显示
              <input id="show" name="show" type="radio" value="2">隐藏
              <?php } else { ?>
              <input id="show" name="show" type="radio" value="1">显示
              <input id="show" name="show" type="radio" value="2" checked>隐藏
              <?php } ?>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="submit" value="修改">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>