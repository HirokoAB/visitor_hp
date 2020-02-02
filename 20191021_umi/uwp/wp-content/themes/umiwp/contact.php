<?php
/*
Template Name: お問い合わせ
*/
?>
<?php get_header(); ?>
		
<section>
	<div class="container-fluid inner animated fadeInUp delay-05s">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h2><img src="http://kawatouminovisitorcenter.jp/umi/img/title_con01.png" alt="お問い合わせフォーム" class="center-block img-responsive"></h2>
				<div class="con-box line-box">
			
<?php	if (have_posts()) : // WordPress ループ
		while (have_posts()) : the_post(); // 繰り返し処理開始 ?>
		
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_content(); ?>
<?php	$args = array(
		'before' => '<div class="page-link">',
		'after' => '</div>',
		'link_before' => '<span>',
		'link_after' => '</span>',
		);
		wp_link_pages($args); ?>
</div>

				</div>
			</div>
		</div>
	</div>
</section>

<?php	endwhile; // 繰り返し処理終了		
		else : // ここから記事が見つからなかった場合の処理 ?>
<div class="post">
<h2>記事はありません</h2>
<p>お探しの記事は見つかりませんでした。</p>
</div>
<?php endif; ?>

<footer class="soft-bg">
	<div class="container-fluid">
		<div class="inner">

<?php get_footer(); ?>