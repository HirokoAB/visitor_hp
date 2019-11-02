<?php
/*
Template Name: トップ - ニュース
*/
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>お知らせ</title>

<link href="http://kawatouminovisitorcenter.jp/umi/css/top.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div class="top-news">	
    <?php query_posts('showposts=5'); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <dl><dt>
    <?php the_time('Y年n月j日'); ?>
    </dt>
    <dd><a href="<?php the_permalink() ?>" target="_top" ><?php the_title();?></a>
	<?php
	$days=7; //NEWをつける日数
        $today=date('U'); $entry=get_the_time('U');
        $diff1=date('U',($today - $entry))/86400;
        if ($days > $diff1) {
    echo '<span class="new">NEW</span>';
    }
    ?>
	
	</dd></dl>
    <?php endwhile; endif; ?>

</div>


</body>
</html>