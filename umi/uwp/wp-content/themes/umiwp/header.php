<?php
if (!(ereg("Windows",$_SERVER['HTTP_USER_AGENT']) && ereg("MSIE",$_SERVER['HTTP_USER_AGENT'])) || ereg("MSIE 7",$_SERVER['HTTP_USER_AGENT'])) {
     echo '<?xml version="1.0" encoding="' . get_settings('blog_charset') .'"?>' . "\n";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title(''); ?><?php if (wp_title('', false)) : ?>｜<?php endif; ?><?php bloginfo('name'); ?></title>

<meta name="description" content="<?php bloginfo('description'); ?>" />
<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />
<link href="http://kawatouminovisitorcenter.jp/umi/css/bootstrap.min.css" rel="stylesheet">
<link href="http://kawatouminovisitorcenter.jp/umi/css/drawer.css" rel="stylesheet">
<!--<link href="css/flexslider.css" rel="stylesheet">-->
<link href="http://kawatouminovisitorcenter.jp/umi/css/animate.css" rel="stylesheet">
<link href="http://kawatouminovisitorcenter.jp/umi/css/normalize.css" rel="stylesheet">
<link href="http://kawatouminovisitorcenter.jp/umi/css/style.css" rel="stylesheet">
<link href="http://kawatouminovisitorcenter.jp/umi/css/queries.css" rel="stylesheet">

<link rel="shortcut icon" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="icon" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" sizes="57x57" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="http://kawatouminovisitorcenter.jp/umi/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon-48x48.png" sizes="48x48">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon-160x160.png" sizes="96x96">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon-196x196.png" sizes="96x96">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="http://kawatouminovisitorcenter.jp/umi/favicons/favicon-32x32.png" sizes="32x32">
<link rel="manifest" href="http://kawatouminovisitorcenter.jp/umi/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#2d88ef">
<meta name="msapplication-TileImage" content="http://kawatouminovisitorcenter.jp/umi/favicons/mstile-144x144.png">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body id="top" class="drawer drawer--right">

<nav class="smenu drawer-nav">
	<ul class="drawer-menu">
		<li><a class="drawer-toggle" style="text-align:right;">閉じる</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/index.html">トップ</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/facility.html">施設紹介</a></li>
		<li class="indent"><a href="http://kawatouminovisitorcenter.jp/umi/facility.html#guide">利用案内</a></li>
		<li class="indent"><a href="http://kawatouminovisitorcenter.jp/umi/facility.html#fmap">館内図</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/rent.html">スペース貸出</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/staff.html">スタッフのご紹介</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/issue.html">発刊物</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/program.html">自然体験プログラム</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/environ.html">周辺情報</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/access.html">アクセス</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=5">イベント</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=2">お知らせ</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=9">お問い合わせ</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/policy.html">プライバシーポリシー</a></li>
		<li><a href="http://kawatouminovisitorcenter.jp/umi/sitemap.html">サイトマップ</a></li>
	</ul>
</nav>

<header>
	<nav class="hmenu">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
				<div class="col-sm-2 sp-logo">
					<a href="http://kawatouminovisitorcenter.jp/umi/index.html"><img src="http://kawatouminovisitorcenter.jp/umi/img/site_logo.png" alt="南三陸・海のビジターセンター"></a>
				</div>
				<div class="col-sm-10 text-right pc">
					<div class="h-contact"><a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=9"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu08.png" alt="お問い合わせ"></a></div>
					<div class="menu"> 
						<a href="http://kawatouminovisitorcenter.jp/umi/index.html"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu01.png" alt="トップ"></a>
						<a href="http://kawatouminovisitorcenter.jp/umi/facility.html"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu02.png" alt="施設紹介"></a>
						<a href="http://kawatouminovisitorcenter.jp/umi/program.html"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu03.png" alt="自然体験プログラム"></a>
						<a href="http://kawatouminovisitorcenter.jp/umi/environ.html"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu04.png" alt="周辺情報"></a>
						<a href="http://kawatouminovisitorcenter.jp/umi/access.html"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu05.png" alt="アクセス"></a>
						<a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=5"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu06.png" alt="イベント"></a>
						<a href="http://kawatouminovisitorcenter.jp/umi/info/?page_id=2"><img src="http://kawatouminovisitorcenter.jp/umi/img/menu07.png" alt="お知らせ"></a>
					</div>
					</div>
					
					<a id="nav-toggle" class="drawer-toggle sp"><img src="http://kawatouminovisitorcenter.jp/umi/img/btn_smenu.png" alt="メニュー"></a>
				</div>
				</div>
			</div>
		
	</nav>
</header>


<?php if (file_exists(TEMPLATEPATH."/header_include.php")) : ?>
	<?php include(TEMPLATEPATH."/header_include.php"); ?>
<?php endif; ?>
