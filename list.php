<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php include_once './left.php'; ?>
<?php 
$cate_id = $_GET['id'];
$name = $_GET['name'];
$sql = "select * from ali_article art
          join ali_admin a on art.article_adminid=a.admin_id
          where art.article_cateid = $cate_id and art.article_state = '已发布'
          order by art.article_id desc
          limit 0, 5";
$result_obj = mysqli_query($conn, $sql);
?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $name ?></h3>
        <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?id=<?php echo $row['article_id']; ?>"><?php echo $row['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row['admin_nickname']; ?> 发表于 <?php echo $row['article_addtime']; ?></p>
            <p class="brief"><?php echo $row['article_desc']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row['article_click']; ?>)</span>
              <span class="comment">评论(<?php echo $row['article_cmt']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row['article_good']; ?>)</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/admin/<?php echo $row['article_file']; ?>" alt="">
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
