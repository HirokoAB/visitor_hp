<?php
/*
Template Name: トップ - イベント
*/
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>イベント</title>

<link href="http://kawatouminovisitorcenter.jp/umi/css/top.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div class="top-eve">	
    <?php query_posts('showposts=5'); ?>
    <?php
     $loop = new WP_Query(array("post_type" => "event"));
     if ( $loop->have_posts() ) : while($loop->have_posts()): $loop->the_post();
?>
    <dl><dt><a href="<?php the_permalink() ?>" target="_top" ><?php the_post_thumbnail(); ?></a>
    
    </dt>
    <dd><a href="<?php the_permalink() ?>" target="_top" ><span class="top-eve-title"><?php the_title();?></span></a>
	<?php
	$days=7; //NEWをつける日数
        $today=date('U'); $entry=get_the_time('U');
        $diff1=date('U',($today - $entry))/86400;
        if ($days > $diff1) {
    echo '<span class="new">NEW</span>';
    }
    ?><br>
	<span class="top-eve-day"><?php the_time('Y年n月j日'); ?></span><br>
	<span class="top-eve-text"><a href="<?php the_permalink() ?>" target="_top" ><?php echo mb_substr(strip_tags($post-> post_content),0,50).'...'; ?></a></span>
	</dd></dl>
    <?php endwhile; endif; ?>

</div>


</body>
</html>