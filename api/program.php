<?php
// -----------------------------------------------------------------------------
//
// /api/program.php
//
// API プログラム一覧
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
		require_once(DATA_PATH. 'class/class.Program.php');	// プログラム処理クラス
		$classProgram = new classProgram();

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
		$arrNotice['error'] = array_merge($arrNotice['error'], $classProgram->check($arrSearch, 'search'));
		if (!empty($arrNotice['error'])) throw new Exception(400);

		// -----------------------------------------------------
		// 検索結果の取得
		// -----------------------------------------------------
        $arrSearch = array_merge($arrSearch, [
            'public_flag' => 1,
            'order'       => [
				'dtb_program.sort ASC',
				'dtb_program.program_id DESC'
			]
        ]);
        $arrColumn = [
            'dtb_program.program_id',
            'dtb_program.name',
        ];
        $arrList = $classProgram->search($arrSearch, $arrColumn);

		// -----------------------------------------------------
        // 詳細の取得
		// -----------------------------------------------------
        if (0 < count($arrList)) {
            foreach($arrList as $key => $value) {
                $arrList[$key]['public_date'  ] = $classUtility->formatDate('Y.m.d', $value['public_start']);   // 公開日
                $arrList[$key]['category_name'] = $arrMaster['program_category'][$value['category_id']]['name'];   // カテゴリ名
                $arrSearch = [
                    'program_id'  => $value['program_id'],
                    'public_flag' => 1,
                    'order'       => [
						'dtb_program_detail.sort ASC',
						'dtb_program_detail.program_detail_id DESC'
					]
                ];
                $arrColumn = [
                    'dtb_program_detail.program_detail_id',
                    'dtb_program_detail.title',
                    'dtb_program_detail.text',
                    'dtb_program_detail.image',
                    'dtb_program_detail.image_text',
                    'dtb_program_detail.file',
                    'dtb_program_detail.file_text',
                ];
                $arrDetail = $classProgram->detail($arrSearch, $arrColumn);

                // 詳細の整形
                $arrList[$key]['detail'] = [];
                if (0 < count($arrDetail)) {
                    foreach($arrDetail as $key2 => $value2) {
                        $arrRet = $value2;
                        if (!$classUtility->isBlank($arrRet['image']) && $classUtility->isFile(UPLOAD_PATH. $arrRet['image'])) {
                            $arrRet['image_path'] = UPLOAD_URL. $arrRet['image'];
                            $arrRet['image_size'] = $classUtility->formatBytes(filesize(UPLOAD_PATH. $arrRet['image']));
                        }
                        if (!$classUtility->isBlank($arrRet['file']) && $classUtility->isFile(UPLOAD_PATH. $arrRet['file'])) {
                            $arrRet['file_path'] = UPLOAD_URL. $arrRet['file'];
                            $arrRet['file_size'] = $classUtility->formatBytes(filesize(UPLOAD_PATH. $arrRet['file']));
                        }
                        $arrList[$key]['detail'][] = $arrRet;
                    }
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
