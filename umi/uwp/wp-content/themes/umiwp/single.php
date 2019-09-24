<?php
/*
Template Name: イベント
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

<?php if (have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


<section>
	<div class="container-fluid inner wp-fiu1">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
			<div class="line-box">
				<h2 id="post-<?php the_ID(); ?>">
<?php the_title(); ?>
<?php
	$days=7; //NEWをつける日数
        $today=date('U'); $entry=get_the_time('U');
        $diff1=date('U',($today - $entry))/86400;
        if ($days > $diff1) {
    echo '<span class="new">NEW</span>';
    }
    ?><span class="day"><?php the_time('Y/m/d'); ?></span></h2>
	
				<div class="text-box"><?php the_content();?></div>

<?php
	endwhile; // 繰り返し処理終了		
	else : // ここから記事が見つからなかった場合の処理 ?>

<p>記事はありません</p>
<p>お探しの記事は見つかりませんでした。</p>

<?php endif;?>

			<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-size="small" style="margin:0 0 0 auto;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fkawatouminovisitorcenter.jp%2Fumi%2Findex.html&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェア</a></div>
			<!-- <div class="twitter-share"><a target="_blank" href="http://twitter.com/share?url=<?php echo the_permalink(); ?>&text=南三陸海のビジターセンター">twitter</a></div>
 -->

			</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="list-head"><a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=2">お知らせ一覧</a></div>
			</div>
		</div>
	</div>
</section>




<footer class="soft-bg">
	<div class="container-fluid">

<?php get_footer(); ?>