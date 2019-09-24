/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
var current = (function() {
	var src;
    if (document.currentScript) {
        src = document.currentScript.src;
    } else {
        var scripts = document.getElementsByTagName('script'),
		script = scripts[scripts.length-1];
        if (script.src) {
            src = script.src;
        }
	}
	src = src.replace(location.protocol + '//' + location.host, '');
	var arr = src.split('/');
	src = src.replace(arr[arr.length -1], '');
	return src;
})();

CKEDITOR.timestamp            = '19700101';				// キャッシュをクリア
CKEDITOR.config.extraPlugins  = 'wordcount,codemirror';	// プラグインの読み込み

// 共通設定
CKEDITOR.config.language               = 'ja';																				// 言語
CKEDITOR.config.scayt_autoStartup      = false;																				// スペルチェック
CKEDITOR.config.fillEmptyBlocks        = false;																				// 自動で空白を挿入
CKEDITOR.config.allowedContent         = true;																				// タグのフィルタリング無効
CKEDITOR.config.shiftEnterMode         = CKEDITOR.ENTER_P;																	// Shift+Enterを押した際に段落タグを挿入
CKEDITOR.config.enterMode              = CKEDITOR.ENTER_BR;																	// 改行
CKEDITOR.config.coreStyles_bold        = { element : 'span', attributes : { 'style': 'font-weight:bold;'             } };	// 太字
CKEDITOR.config.coreStyles_italic      = { element : 'span', attributes : { 'style': 'font-style:italic;'            } };	// 斜体
CKEDITOR.config.coreStyles_underline   = { element : 'span', attributes : { 'style': 'text-decoration:underline;'    } };	// 下線
CKEDITOR.config.coreStyles_strike      = { element : 'span', attributes : { 'style': 'text-decoration:line-through;' } };	// 打ち消し線
CKEDITOR.config.coreStyles_subscript   = { element : 'span', attributes : { 'style': 'vertical-align:sub;'           } };	// 下付き
CKEDITOR.config.coreStyles_superscript = { element : 'span', attributes : { 'style': 'vertical-align:super;'         } };	// 上付き
CKEDITOR.config.toolbar                = [
	['Undo', 'Redo'],
	['FontSize', '-', 'TextColor', 'BGColor'],
	['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
	['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
	['Link', 'Unlink', 'Anchor'],
	['Image'],
	['Source'],
];

// kcfinder設定
CKEDITOR.config.filebrowserImageBrowseUrl = current + '../kcfinder/browse.php?type=images';	// 閲覧URL（画像）
CKEDITOR.config.filebrowserImageUploadUrl = current + '../kcfinder/upload.php?type=images';	// 格納URL（画像）
CKEDITOR.config.filebrowserBrowseUrl      = current + '../kcfinder/browse.php?type=files';	// 閲覧URL（ファイル）
CKEDITOR.config.filebrowserUploadUrl      = current + '../kcfinder/upload.php?type=files';	// 格納URL（ファイル）

// 個別設定
for(var i in CKEDITOR.instances) {
	var $conf = CKEDITOR.instances[i].config;

	// 各要素の属性から値を取得
	var $obj = document.getElementsByName(i);
	if ($obj[0]) {

		// CSS（半角カンマ区切りで複数指定可）
		var contentsCss = [];
		var css = $obj[0].getAttribute('data-css');
		if (css) { contentsCss = css.split(','); }
		$conf.contentsCss = contentsCss;

		// 横幅
		var contentsWidth  = $obj[0].offsetWidth;
		$conf.width        = contentsWidth;

		// 縦幅
		var contentsHeight = $obj[0].offsetHeight;
		$conf.height= (100 > contentsHeight) ? 100: contentsHeight;

		// 文字数の上限
		var maxCharCount = -1;
		var max = $obj[0].getAttribute('maxlength');
		if (max) { maxCharCount = parseInt(max); }
		$conf.wordcount = {
			showParagraphs    : false,			// 段落カウントを表示するかどうか
			showWordCount     : false,			// 単語数をカウントするかどうか
			showCharCount     : true,			// 文字数をカウントするかどうか
			countHTML         : false,			// HTMLの文字を文字数カウントに含めるかどうか
			countSpacesAsChars: true,			// スペースの文字を文字数カウントに含めるかどうか
			countLineBreaks   : true,			// 改行を文字数カウントに含めるかどうか
			maxCharCount      : maxCharCount,	// 文字数の上限（-1は無制限）
		};
	}

}
