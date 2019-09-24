<?php
// -----------------------------------------------------------------------------
//
// /api/issue.php
//
// API 発刊物一覧
//
//
// 2018.03.06 作間 新規作成
//
// -----------------------------------------------------------------------------
	try {
		// -----------------------------------------------------
		// 初期設定
		// -----------------------------------------------------
		require_once(realpath(dirname(__FILE__). '/../require.php'));	// 共通ファイル

		// -----------------------------------------------------
		// 各処理クラスの読み込み
		// -----------------------------------------------------
		require_once(DATA_PATH. 'class/class.Issue.php');	// 発刊物処理クラス
		$classIssue = new classIssue();

		// -----------------------------------------------------
		// AJAXチェック
		// -----------------------------------------------------
		if (true !== $classUtility->isAjax()) throw new Exception(403);

		// -----------------------------------------------------
		// フォーム内容を取得
		// -----------------------------------------------------
		$arrForm = $classUtility->getForm();
		$arrSearch = ($classUtility->isBlank($arrForm['search'])) ? []: $arrForm['search'];

		// -----------------------------------------------------
		// フォームチェック
		// -----------------------------------------------------
		$arrNotice['error'] = array_merge($arrNotice['error'], $classIssue->check($arrSearch, 'search'));
		if (!empty($arrNotice['error'])) throw new Exception(400);

		// -----------------------------------------------------
		// 検索結果の取得
		// -----------------------------------------------------
        $arrSearch = array_merge($arrSearch, [
            'public_flag' => 1,
            'order'       => [
				'dtb_issue.sort ASC',
				'dtb_issue.issue_id DESC'
			]
        ]);
        $arrColumn = [
            'dtb_issue.issue_id',
            'dtb_issue.title',
            'dtb_issue.text',
            'dtb_issue.image',
            'dtb_issue.image_text',
            'dtb_issue.file',
            'dtb_issue.file_text',
        ];
        $arrList = $classIssue->search($arrSearch, $arrColumn);

        if (0 < count($arrList)) {
            foreach($arrList as $key => $value) {
                if (!$classUtility->isBlank($value['image']) && $classUtility->isFile(UPLOAD_PATH. $value['image'])) {
                    $arrList[$key]['image_path'] = UPLOAD_URL. $value['image'];
                    $arrList[$key]['image_size'] = $classUtility->formatBytes(filesize(UPLOAD_PATH. $value['image']));
                }
                if (!$classUtility->isBlank($value['file']) && $classUtility->isFile(UPLOAD_PATH. $value['file'])) {
                    $arrList[$key]['file_path'] = UPLOAD_URL. $value['file'];
                    $arrList[$key]['file_size'] = $classUtility->formatBytes(filesize(UPLOAD_PATH. $value['file']));
                }
            }
        }

		$arrResult = [
            'list'  => $classUtility->spaceConvert($arrList),
		];

	} catch (Exception $e) {
        $arrResult = [
            'result' => false,
            'error'  => $e->getMessage()
        ];
	}

	// -----------------------------------------------------
	// JSON形式で出力
	// -----------------------------------------------------
	header('Content-type: application/json;');
    echo json_encode($arrResult);
	exit(0);
?>
