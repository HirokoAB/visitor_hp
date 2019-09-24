<?php get_header(); ?>
	
<div id="main">	

<h2 class="title-news"></h2>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); /* ループ開始 */ ?>


<div class="main-box">

<!-- エントリータイトル -->
<h4 id="post-<?php the_ID(); ?>" class="title-news"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
<?php the_title(); ?>
</a>
<?php
	$days=7; //NEWをつける日数
        $today=date('U'); $entry=get_the_time('U');
        $diff1=date('U',($today - $entry))/86400;
        if ($days > $diff1) {
    echo '<span class="new">NEW</span>';
    }
    ?>
</h4>

<!-- エントリー日付 -->
<div class="day-box">
<?php the_time('Y/m/d','<div class="entry-date">','</div>'); ?>
</div>

<!-- エントリー本文 -->
<div class="info-box">
<?php the_content(__('(more...)')); ?>
<div class="entry-body-link-pages-navi">
<?php wp_link_pages(); ?>
</div>
<!-- entry-body-link-pages-navi_end --> 
</div>

</div>
<!-- [end]main-box -->

<?php
	endwhile; // 繰り返し処理終了		
	else : // ここから記事が見つからなかった場合の処理 ?>
<div class="post">
<h2>記事はありません</h2>
<p>お探しの記事は見つかりませんでした。</p>
</div>


<?php endif;?>


<?php if (function_exists("pagination")) {
	pagination ($additional_loop -> max_num_pages);
} ?>

</div>



<?php get_sidebar(); ?>
<?php get_footer(); ?>