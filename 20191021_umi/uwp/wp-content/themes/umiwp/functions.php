<?php

// カスタム投稿タイプの追加
add_action( 'init', 'create_post_type' );

function create_post_type() {
register_post_type( 'event', // 投稿タイプ名の定義
array(
'labels' => array(
'name' => __( 'イベント' ), // 表示する投稿タイプ名
'singular_name' => __( 'イベント' )
),
'supports' => array( 'title', 'editor', 'thumbnail' ),
'public' => true,
'menu_position' =>5,
)
);
}

// サムネイル画像を利用
add_theme_support( 'post-thumbnails', array( 'event' ) );
set_post_thumbnail_size( 100, 100, true );




//ページネーション
function pagination($pages = '', $range = 2)
{
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
			}
		}
		
	if(1 != $pages)
	{
		echo "<div class='pagination'>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
		
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}
		
		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
	}
}
?>