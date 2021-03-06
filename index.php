<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===TOPページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();


$currentPageNum_top = (!empty($_GET['p'])) ? $_GET['p'] : 1;
if(!is_int((int)$currentPageNum_top)){
  error_log('エラー発生：指定ページに不正な値が入りました。');
  header("Location:index.php");
}

// 表示件数
$listSpan = 10;
// 現在の表示レコードの先頭を算出
$currentMinNum_top = (($currentPageNum_top-1)*$listSpan);
// DBから投稿データを取得
$dbPostData = getPostList($currentMinNum_top);
debug('現在のページ：'.$currentPageNum_top);


debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = 'TOP';
  require('head.php');
?>
<body class="bg-colorB">
  <!-- ヘッダー -->
  <?php
    require('header.php');
  ?>

  <!-- メインコンテンツ -->


  <div class="hero">
    <div class="hero-title">
      <h2>Let's share your best music, best lyrics.</h2>
    </div>
  </div>
  
  
  <section id="about" class="container">
    <div class="section-title">
      <h2>About</h2>
    </div>
    
    <div class="section-contents p-about">
      Fav Lyricsは自分のお気に入りの曲の歌詞を共有できるサービスです。もちろん他の人のお気に入りの歌詞を見ることもできます。一人のときに聞いた曲、友達・恋人と一緒に聴いた曲、ライブ会場で聞いた曲、懐かしい曲、メジャーな曲、周りの人が知らないようなマイナーな曲、テンションが上がる曲、泣けてくる曲...その時感じた想いとともに、お気に入りの歌詞を共有してみませんか。
    </div>
    
  </section>
  
  <section id="posts" class="container">
    <div class="section-title">
      <h2>投稿一覧</h2>
    </div>
    
    <div class="section-contents p-posts">
      
      <?php
        foreach ($dbPostData['data'] as $key => $val):
      ?>
      <a href="postDetail.php?p_id=<?php echo $val['p_id'].'&u_id='.$val['u_id'].'&prev=index'.'&p='.$currentPageNum_top; ?>" class="c-item">
        <div class="c-item-title">
          <h3><?php echo sanitize($val['title']); ?></h3>
        </div>
        <div class="c-item-subtitle">
          <h4><?php echo sanitize($val['music_title']); ?><br> by <span class="artist"><?php echo sanitize($val['artist']); ?></span></h4>
        </div>
        <div class="c-item-text">
          <p><?php echo sanitize(mb_substr($val['lyrics'], 0, 29)); ?>...</p>
        </div>
      </a>
      <?php
        endforeach;
      ?>
      
    </div>
    <?php topPagination($currentPageNum_top, $dbPostData['total_page']); ?>
  </section>

  
  <!-- フッター -->
  <?php
    require('footer.php');
  ?>