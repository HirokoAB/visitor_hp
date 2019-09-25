<?php
// -----------------------------------------------------------------------------
//
// /api/info.php
//
// API お知らせ一覧
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
		require_once(DATA_PATH. 'class/class.Info.php');	// お知らせ処理クラス
		$classInfo = new classInfo();

		// -----------------------------------------------------
		// AJAXチェック
		// -----------------------------------------------------
		if (true !== $classUtility->isAjax()) throw new Exception(403);

		// -----------------------------------------------------
		// フォーム内容を取得
		// -----------------------------------------------------
		$arrForm = $classUtility->getForm();
		$arrSearch = ($classUtility->isBlank($arrForm['search'])) ? []: $arrForm['search'];
        $arrForm['page' ] = (!$classUtility->isBlank($arrForm['page' ])) ? $arrForm['page' ]: 1;	// ページ番号
        $arrForm['limit'] = (!$classUtility->isBlank($arrForm['limit'])) ? $arrForm['limit']: 5;	// 取得件数

		// -----------------------------------------------------
		// フォームチェック
		// -----------------------------------------------------
		$arrNotice['error'] = array_merge($arrNotice['error'], $classInfo->check($arrSearch, 'search'));
		if (!empty($arrNotice['error'])) throw new Exception(400);

		// -----------------------------------------------------
		// 検索結果の取得
		// -----------------------------------------------------
        $arrSearch = array_merge($arrSearch, [
            'public_flag' => 1,
            'order'       => [
				'dtb_info.public_start DESC',
				'dtb_info.info_id DESC'
			]
        ]);
        $arrColumn = [
            'dtb_info.info_id',
            'dtb_info.category_id',
            'dtb_info.public_start',
            'dtb_info.public_end',
            'dtb_info.name',
        ];
        $arrList = $classInfo->search($arrSearch, $arrColumn);

		// -----------------------------------------------------
		// ページャーの設定
		// -----------------------------------------------------
		if (!$classUtility->isBlank($arrList)) {
            $exis = false;
    		if (!$classUtility->isBlank($arrForm['id'])) {
                foreach($arrList as $key => $value) {
                    if ($arrForm['id'] == $value['info_id']) {
                        $exis = true;
                        $arrForm['page'] = ceil(($key + 1) / $arrForm['limit']);
                    }
                }
            }
    		if (!$classUtility->isBlank($arrForm['id']) && false == $exis) {
                $arrList = [];
            } else {
                $arrPager = $classUtility->getPager($arrForm['page'], $arrForm['limit'], count($arrList), $arrForm['search'], 3);
                $arrSearch = array_merge($arrSearch, array(
                    'limit' => array(
                        $arrPager['record_offset'],	// 取得開始位置
                        $arrPager['record_limit' ],	// 取得数
                    ),
                ));
                $arrList = $classInfo->search($arrSearch, $arrColumn);
            }
    	}

		// -----------------------------------------------------
        // 詳細の取得
		// -----------------------------------------------------
        if (0 < count($arrList)) {
            foreach($arrList as $key => $value) {
                $arrList[$key]['public_date'   ] = $classUtility->formatDate('Y.m.d', $value['public_start']);      // 公開日
                $arrList[$key]['category_name' ] = $arrMaster['info_category'][$value['category_id']]['name' ];     // カテゴリ名
                $arrList[$key]['category_style'] = $arrMaster['info_category'][$value['category_id']]['style'];     // カテゴリスタイル
                $arrSearch = [
                    'info_id'     => $value['info_id'],
                    'public_flag' => 1,
                    'order'       => [
						'dtb_info_detail.sort ASC',
						'dtb_info_detail.info_detail_id DESC'
					]
                ];
                $arrColumn = [
                    'dtb_info_detail.info_detail_id',
                    'dtb_info_detail.text',
                    'dtb_info_detail.image',
                    'dtb_info_detail.image_text',
                    'dtb_info_detail.file',
                    'dtb_info_detail.file_text',
                ];
                $arrDetail = $classInfo->detail($arrSearch, $arrColumn);

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
            'pager' => $arrPager
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