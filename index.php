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
    <div class="content">
      <div class="swipe">
<?php  
$sql = "select * from ali_pic";
$result_obj = mysqli_query($conn, $sql);
?>
        <ul class="swipe-wrapper">
        <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
          <li>
            <a href="<?php echo $row['pic_link']; ?>">
              <img src="/admin/admin/<?php echo $row['pic_url']; ?>">
              <span><?php echo $row['pic_text']; ?></span>
            </a>
          </li>
          <?php } ?>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
<?php  
$sql = "select * from ali_article order by article_id desc limit 0, 5";
$result_obj = mysqli_query($conn, $sql);
?>
        <ul>
          <?php 
          $num = 0;
          while ($row = mysqli_fetch_assoc($result_obj)) { 
          ?>
          <li <?php if ($num == 0) echo 'class="large"' ?> >
            <a href="detail.php?id=<?php echo $row['article_id']; ?>">
              <img src="/admin/admin/<?php echo $row['article_file']; ?>" alt="">
              <span><?php echo $row['article_title'] ?></span>
            </a>
          </li>
          <?php 
          $num++;
          } 
          ?>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
<?php  
$sql = "select * from ali_article order by article_click desc limit 0, 5";
$result_obj = mysqli_query($conn, $sql);
?>
        <ol>
          <?php
          $num = 1; 
          while ($row = mysqli_fetch_assoc($result_obj)) { 
          ?>
          <li>
            <i><?php echo $num++; ?></i>
            <a href="detail.php?id=<?php echo $row['article_id']; ?>"><?php echo $row['article_title']; ?></a>
            <a href="javascript:;" class="like">赞(<?php echo $row['article_good']; ?>)</a>
            <span>阅读 (<?php echo $row['article_click']; ?>)</span>
          </li>
          <?php } ?>
        </ol>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
<?php  
$sql = "select * from ali_article order by article_good desc limit 0, 4";
$result_obj = mysqli_query($conn, $sql);
?>
        <ul>
          <?php while ($row = mysqli_fetch_assoc($result_obj)) {  ?>
          <li>
            <a href="detail.php?id=<?php echo $row['article_id']; ?>">
              <img src="/admin/admin/<?php echo $row['article_file']; ?>" alt="">
              <span><?php echo $row['article_title']; ?></span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <div class="panel new">
        <h3>最新发布</h3>
<?php  
$sql = "select * from ali_article art
          join ali_cate c on art.article_cateid=c.cate_id
          join ali_admin a on art.article_adminid=a.admin_id
          order by article_id desc limit 0, 3";
$result_obj = mysqli_query($conn, $sql);
?>
        <?php while ($row = mysqli_fetch_assoc($result_obj)) {  ?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?php echo $row['cate_name']; ?></span>
            <a href="detail.php?id=<?php echo $row['article_id']; ?>"><?php echo $row['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row['admin_nickname']; ?> 发表于 2015-06-29</p>
            <p class="brief"><?php echo $row['article_desc']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row['article_click']; ?>)</span>
              <span class="comment">评论(<?php echo $row['article_cmt']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row['article_good']; ?>)</span>
              </a>
            </p>
            <a href="detail.php?id=<?php echo $row['article_id']; ?>" class="thumb">
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
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>
