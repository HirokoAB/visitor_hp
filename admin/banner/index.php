<?php
// -----------------------------------------------------------------------------
//
// /admin/banner/index.php
//
// 管理画面 スライドバナー一覧
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
		define('BODY_ID', 'banner');	// 処理別の識別子

		// -----------------------------------------------------
		// ログインチェック
		// -----------------------------------------------------
		if (!$classAuth->check()) $classUtility->redirect(ADMIN_URL);
		$arrLogin = $_SESSION['admin'];

		// -----------------------------------------------------
		// 各処理クラスの読み込み
		// -----------------------------------------------------
		require_once(DATA_PATH. 'class/class.Banner.php');	// スライドバナー処理クラス
		$classBanner = new classBanner();

		// -----------------------------------------------------
		// フォーム内容を取得
		// -----------------------------------------------------
		$arrForm = $classUtility->getForm();
		$arrSearch = ($classUtility->isBlank($arrForm['search'])) ? []: $arrForm['search'];
		$arrSearch = array_merge($classUtility->getSearch(), $arrSearch);

		// -----------------------------------------------------
		// フォームチェック
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// 上へ
			case 'up':
				if (false == $classUtility->tokenCheck($arrForm['token'], 'admin')) throw new Exception(400);
				$arrNotice['error'] = array_merge($arrNotice['error'], $classBanner->check($arrForm, 'up'));
				break;

			// 下へ
			case 'down':
				if (false == $classUtility->tokenCheck($arrForm['token'], 'admin')) throw new Exception(400);
				$arrNotice['error'] = array_merge($arrNotice['error'], $classBanner->check($arrForm, 'down'));
				break;

			// 検索条件の消去
			case 'clear':
				break;

			// 検索結果の取得
			default:
				$arrNotice['error'] = array_merge($arrNotice['error'], $classBanner->check($arrSearch, 'search'));
				break;
		}
		if (!empty($arrNotice['error'])) $arrForm['mode'] = '';

		// -----------------------------------------------------
		// 処理分岐
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// 並び替え
			case 'up':
			case 'down':
				try {
					$classPdo->begin();	// トランザクション開始
					$result = $classBanner->sort($arrForm['mode'], $arrForm['banner_id']);
					$classPdo->commit();	// コミット
				} catch (Exception $e) {
					$classPdo->rollBack();	// ロールバック
					throw new Exception($e->getMessage());
				}
				$classUtility->redirect($arrPath['dirname']. '/', ['error' => $arrNotice['error']]);
				break;

			// 検索条件の消去
			case 'clear':
				$classUtility->clearSearch();
				$classUtility->redirect($_SERVER['REQUEST_URI'], ['success' => '検索条件をクリアしました']);
				break;

			// 検索結果の取得
			default:
				$arrSearch = array_merge($arrSearch, [
					'delete_flag' => 0,
					'order'       => 'dtb_banner.sort ASC'
				]);
				$arrSearch = $classUtility->setSearch($arrSearch);
				$arrColumn = [
					'dtb_banner.banner_id',
					'dtb_banner.position_id',
					'dtb_banner.name',
					'dtb_banner.image',
					'dtb_banner.status_flag',
				];
				$arrSearch['status_flag'] = ($classUtility->isBlank($arrSearch['status_flag'])) ? []: $arrSearch['status_flag'];	// 公開設定
				$arrSearch['position_id'] = ($classUtility->isBlank($arrSearch['position_id'])) ? []: $arrSearch['position_id'];	// 拠点
				$arrList = ($classUtility->isBlank($arrForm['mode']) || $classUtility->isBlank($arrNotice['error'])) ? $classBanner->search($arrSearch, $arrColumn): [];
				$arrForm['search'] = $arrSearch;
				break;
		}

		// -----------------------------------------------------
		// 外部読み込みファイル設定
		// -----------------------------------------------------
		$arrInclude = [
			'css' => ['css/contents/banner.css'],
			'js'  => ['js/contents/banner.js'  ],
		];

		// -----------------------------------------------------
		// テンプレート設定
		// -----------------------------------------------------
		define('TEMPLATE' , 'admin/banner/index.tpl'           );	// テンプレートファイル名
		define('SUB_TITLE', 'スライドバナーの一覧・並び替え'   );	// ページサブタイトル
		define('TOKEN'    , $classUtility->tokenCreate('admin'));	// ワンタイムトークン

	} catch (Exception $e) {
		$arrResult = $classUtility->error($e->getMessage());
		$arrNotice['error'] = $arrResult['error'];
		define('TEMPLATE' , $arrResult['template' ]);	// テンプレートファイル名
		define('SUB_TITLE', $arrResult['sub_title']);	// ページサブタイトル
		$classUtility->header($e->getMessage());
	}

	// -----------------------------------------------------
	// Smarty出力
	// -----------------------------------------------------
	if (!$classUtility->isBlank($arrMaster )) $classSmarty->assign('arrMaster' , $arrMaster );	// マスタ配列
	if (!$classUtility->isBlank($arrNotice )) $classSmarty->assign('arrNotice' , $arrNotice );	// 通知配列
	if (!$classUtility->isBlank($arrLogin  )) $classSmarty->assign('arrLogin'  , $arrLogin  );	// ログイン管理者情報
	if (!$classUtility->isBlank($arrInclude)) $classSmarty->assign('arrInclude', $arrInclude);	// 外部読み込みファイル
	if (!$classUtility->isBlank($arrForm   )) $classSmarty->assign('arrForm'   , $arrForm   );	// フォーム内容
	if (!$classUtility->isBlank($arrList   )) $classSmarty->assign('arrList'   , $arrList   );	// 検索結果

	$classSmarty->display_Extends(ADMIN_FRAME);	// テンプレート出力
	exit(0);
?>
