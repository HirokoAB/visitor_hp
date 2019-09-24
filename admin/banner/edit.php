<?php
// -----------------------------------------------------------------------------
//
// /admin/banner/edit.php
//
// 管理画面 スライドバナー編集
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
		$arrEdit = ($classUtility->isBlank($arrForm['edit'])) ? []: $arrForm['edit'];

		// -----------------------------------------------------
		// フォームチェック
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// 削除
			case 'delete':
				if (false == $classUtility->tokenCheck($arrForm['token'], 'admin')) throw new Exception(400);
				$arrNotice['error'] = array_merge($arrNotice['error'], $classBanner->check($arrForm, 'delete'));
				if (!$classUtility->isBlank($arrNotice['error'])) $classUtility->redirect($arrPath['dirname']. '/', ['error' => $arrNotice['error']]);
				break;

			// 保存
			case 'save':
				if (false == $classUtility->tokenCheck($arrForm['token'], 'admin')) throw new Exception(400);
				$arrNotice['error'] = array_merge($arrNotice['error'], $classBanner->check($arrEdit, 'save'));
				break;

			// 編集
			case 'edit':
				$arrNotice['error'] = array_merge($arrNotice['error'], $classBanner->check($arrForm, 'edit'));
				if (!$classUtility->isBlank($arrNotice['error'])) $classUtility->redirect($arrPath['dirname']. '/', ['error' => $arrNotice['error']]);
				break;

			// 新規
			default:
				break;
		}
		if (!empty($arrNotice['error'])) $arrForm['mode'] = 'error';

		// -----------------------------------------------------
		// 処理分岐
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// エラー
			case 'error':
				break;

			// 削除
			case 'delete':
				try {
					$classPdo->begin();	// トランザクション開始
					$count = $classBanner->delete($arrForm['banner_id']);
					$classPdo->commit();	// コミット
				} catch (Exception $e) {
					$classPdo->rollBack();	// ロールバック
					throw new Exception($e->getMessage());
				}
				$classUtility->redirect($arrPath['dirname']. '/', ['success' => 'スライドバナーID：'. $arrForm['banner_id']. ' を削除しました']);
				break;

			// 保存
			case 'save':
				try {
					$classPdo->begin();	// トランザクション開始
					$arrEdit['banner_id'] = $classBanner->save($arrEdit);
					$classPdo->commit();	// コミット
				} catch (Exception $e) {
					$classPdo->rollBack();	// ロールバック
					throw new Exception($e->getMessage());
				}
				$classUtility->redirect($arrPath['dirname']. '/', ['success' => 'スライドバナーID：'. $arrEdit['banner_id']. ' を保存しました']);
				break;

			// 編集
			case 'edit':
				$arrSearch = [
					'banner_id'     => $arrForm['banner_id'],
					'delete_flag' => 0,
					'limit'       => 1
				];
				$arrColumn = [
					'dtb_banner.*',
					'dtb_admin.admin_name',
				];
				$arrRet = $classBanner->search($arrSearch, $arrColumn);
				$arrEdit = (0 < count($arrRet)) ? $arrRet[0]: [];
				break;

			// 新規
			default:
				$arrEdit = [];
				break;
		}

		// -----------------------------------------------------
		// 初期設定
		// -----------------------------------------------------
		if ($classUtility->isBlank($arrEdit['status_flag'])) $arrEdit['status_flag'] = 0;	// 公開設定

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
		$sub_title = ($classUtility->isBlank($arrEdit['banner_id'])) ? 'スライドバナーの新規登録': 'スライドバナーID：'. $arrEdit['banner_id']. ' の編集';
		define('TEMPLATE' , 'admin/banner/edit.tpl'            );	// テンプレートファイル名
		define('SUB_TITLE', $sub_title                         );	// ページサブタイトル
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
	if (!$classUtility->isBlank($arrEdit   )) $classSmarty->assign('arrEdit'   , $arrEdit   );	// 編集用配列

	$classSmarty->display_Extends(ADMIN_FRAME);	// テンプレート出力
	exit(0);
?>
