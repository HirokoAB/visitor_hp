<?php
// -----------------------------------------------------------------------------
//
// /kawa/download.php
//
// ファイルのダウンロード
//
//
// 2018.03.06 作間 新規作成
//
// -----------------------------------------------------------------------------
	try {
		// -----------------------------------------------------
		// 初期設定
		// -----------------------------------------------------
		require_once(realpath(dirname(__FILE__). '/require.php'));	// 共通ファイル

		// -----------------------------------------------------
		// フォーム内容を取得
		// -----------------------------------------------------
		$arrForm = $classUtility->getForm();

		// -----------------------------------------------------
		// ダウンロードするファイルの設定
		// -----------------------------------------------------
        $arrForm['path'] = HTML_PATH. $arrForm['file'];
		$arrForm['mode'] = (empty($arrForm['mode'])) ? 'download': $arrForm['mode'];

		// -----------------------------------------------------
		// ダウンロードするファイルの読み込み
		// -----------------------------------------------------
        if (!file_exists($arrForm['path']) || !is_file($arrForm['path'])) throw new Exception(404);
        $arrForm['data'] = file_get_contents($arrForm['path']);
        $arrForm['name'] = basename($arrForm['path']);

		// -----------------------------------------------------
		// ダウンロード
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// ファイル情報（JSON形式）
			case 'info':
				header('Content-type: application/json;');
				echo json_encode($classUtility->getFileInfo($arrForm['path']));
				exit(0);
				break;

			// ダウンロード
			default:
				header('Content-disposition: attachment; filename='. $arrForm['name']);
				header('Content-type: application/octet-stream; name='. $arrForm['name']);
				header('Content-Length: '. strlen($arrForm['data']));
				header('Cache-Control: ');
				header('Pragma: ');
				echo $arrForm['data'];
				exit(0);
				break;
		}

	} catch (Exception $e) {
		$arrResult = $classUtility->error($e->getMessage(), true);
		$arrNotice['error'] = $arrResult['error'];
		define('TEMPLATE' , $arrResult['template' ]);	// テンプレートファイル名
		define('SUB_TITLE', $arrResult['sub_title']);	// ページサブタイトル
		$arrResult = $classUtility->header($e->getMessage());
	}
?>
