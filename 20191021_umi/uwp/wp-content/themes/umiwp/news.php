<?php
/*
Template Name: お知らせ
*/
?>

<?php get_header(); ?>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 sec-img-box animated fadeInUp">
				<div class="sec-top-img bg-news"></div>
				<div class="sec-cover"></div>
				<div class="sec-top-item01"></div>
				<div class="sec-top-item02"></div>
				<h1 class="title-sec"><img src="http://kawatouminovisitorcenter.jp/umi/img/title_news.png" alt="お知らせ" class="center-block img-responsive"></h1>
			</div>
		</div>
	</div>
</section>

<?php
$args = array(
     'post_type' => 'post', /* 投稿タイプを指定 */
     'paged' => $paged,
); ?>
<?php query_posts( $args ); ?>

<?php if (have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


<section>
	<div class="container-fluid inner wp-fiu1">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
			<div class="line-box">
				<h2 id="post-<?php the_ID(); ?>">
<a href="<?php the_permalink() ?>"><?php the_title(); ?>
<?php
	$days=7; //NEWをつける日数
        $today=date('U'); $entry=get_the_time('U');
        $diff1=date('U',($today - $entry))/86400;
        if ($days > $diff1) {
    echo '<span class="new">NEW</span>';
    }
    ?><span class="day"><?php the_time('Y/m/d'); ?></span></a></h2>
	
				<div class="text-box"><?php the_content();?></div>

			</div>
			</div>
		</div>
	</div>
</section>

<?php
	endwhile; // 繰り返し処理終了		
	else : // ここから記事が見つからなかった場合の処理 ?>

<section>
	<div class="container-fluid inner wp-fiu1">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
			<div class="line-box">
				<p>記事はありません</p>
				<p>お探しの記事は見つかりませんでした。</p>
			</div>
			</div>
		</div>
	</div>
</section>
<?php endif;?>

<section>
	<div class="container-fluid inner">
		<div class="row text-center">
		<!--<div class="pagination">-->
<?php if (function_exists("pagination")) {
	pagination ($additional_loop -> max_num_pages);
} ?>

<!--</div>-->
		</div>
	</div>
</section>

<footer class="soft-bg">
	<div class="container-fluid">


<?php get_footer(); ?>