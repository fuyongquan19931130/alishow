<div class="header">
  <h1 class="logo"><a href="index.php"><img src="assets/img/logo.png" alt=""></a></h1>
<?php  
include_once './admin/include/mysqli.php';
$sql = "select * from ali_cate";
$result_obj = mysqli_query($conn, $sql);
?>
  <ul class="nav">
    <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
    <li>
      <a href="list.php?id=<?php echo $row['cate_id'];?>&name=<?php echo $row['cate_name'];?>">
        <i class="fa <?php echo $row['cate_icon']; ?>"></i><?php echo $row['cate_name']; ?>
      </a>
    </li>
    <?php } ?>
  </ul>
  <div class="search">
    <form>
      <input type="text" class="keys" placeholder="输入关键字">
      <input type="submit" class="btn" value="搜索">
    </form>
  </div>
  <div class="slink">
    <a href="javarscript:;">链接01</a> | <a href="javarscript:;">链接02</a>
  </div>
</div>
<div class="aside">
  <div class="widgets">
    <h4>搜索</h4>
    <div class="body search">
      <form>
        <input type="text" class="keys" placeholder="输入关键字">
        <input type="submit" class="btn" value="搜索">
      </form>
    </div>
  </div>
  <div class="widgets">
    <h4>随机推荐</h4>
<?php  
$sql = "select * from ali_article order by rand() limit 0, 5";
$result_obj = mysqli_query($conn, $sql);
?>
    <ul class="body random">
      <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
      <li>
        <a href="detail.php?id=<?php echo $row['article_id']; ?>">
          <p class="title"><?php echo $row['article_title']; ?></p>
          <p class="reading">阅读(<?php echo $row['article_click']; ?>)</p>
          <div class="pic">
            <img src="/admin/admin/<?php echo $row['article_file']; ?>" alt="">
          </div>
        </a>
      </li>
      <?php } ?>
    </ul>
  </div>
  <div class="widgets">
    <h4>最新评论</h4>
<?php  
$sql = "select * from ali_comment cmt
        join ali_member m on cmt.cmt_memid=m.member_id
        order by cmt_id desc limit 0, 6";
$result_obj = mysqli_query($conn, $sql);
?>
    <ul class="body discuz">
      <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="uploads/avatar_1.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span><?php echo $row['member_nickname']; ?></span><?php echo date('Y/m/d', $row['cmt_addtime']); ?>说:
            </p>
            <p><?php echo $row['cmt_content']; ?></p>
          </div>
        </a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>