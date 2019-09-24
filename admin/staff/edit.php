<?php
// -----------------------------------------------------------------------------
//
// /admin/staff/edit.php
//
// 管理画面 スタッフ編集
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
		define('BODY_ID', 'staff');	// 処理別の識別子

		// -----------------------------------------------------
		// ログインチェック
		// -----------------------------------------------------
		if (!$classAuth->check()) $classUtility->redirect(ADMIN_URL);
		$arrLogin = $_SESSION['admin'];

		// -----------------------------------------------------
		// 各処理クラスの読み込み
		// -----------------------------------------------------
		require_once(DATA_PATH. 'class/class.Staff.php');	// スタッフ処理クラス
		$classStaff = new classStaff();

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
				$arrNotice['error'] = array_merge($arrNotice['error'], $classStaff->check($arrForm, 'delete'));
				if (!$classUtility->isBlank($arrNotice['error'])) $classUtility->redirect($arrPath['dirname']. '/', ['error' => $arrNotice['error']]);
				break;

			// 保存
			case 'save':
				if (false == $classUtility->tokenCheck($arrForm['token'], 'admin')) throw new Exception(400);
				$arrNotice['error'] = array_merge($arrNotice['error'], $classStaff->check($arrEdit, 'save'));
				break;

			// 編集
			case 'edit':
				$arrNotice['error'] = array_merge($arrNotice['error'], $classStaff->check($arrForm, 'edit'));
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
					$count = $classStaff->delete($arrForm['staff_id']);
					$classPdo->commit();	// コミット
				} catch (Exception $e) {
					$classPdo->rollBack();	// ロールバック
					throw new Exception($e->getMessage());
				}
				$classUtility->redirect($arrPath['dirname']. '/', ['success' => 'スタッフID：'. $arrForm['staff_id']. ' を削除しました']);
				break;

			// 保存
			case 'save':
				try {
					$classPdo->begin();	// トランザクション開始
					$arrEdit['staff_id'] = $classStaff->save($arrEdit);
					$classPdo->commit();	// コミット
				} catch (Exception $e) {
					$classPdo->rollBack();	// ロールバック
					throw new Exception($e->getMessage());
				}
				$classUtility->redirect($arrPath['dirname']. '/', ['success' => 'スタッフID：'. $arrEdit['staff_id']. ' を保存しました']);
				break;

			// 編集
			case 'edit':
				$arrSearch = [
					'staff_id'     => $arrForm['staff_id'],
					'delete_flag' => 0,
					'limit'       => 1
				];
				$arrColumn = [
					'dtb_staff.*',
					'dtb_admin.admin_name',
				];
				$arrRet = $classStaff->search($arrSearch, $arrColumn);
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
			'css' => ['css/contents/staff.css'],
			'js'  => ['js/contents/staff.js'  ],
		];

		// -----------------------------------------------------
		// テンプレート設定
		// -----------------------------------------------------
		$sub_title = ($classUtility->isBlank($arrEdit['staff_id'])) ? 'スタッフの新規登録': 'スタッフID：'. $arrEdit['staff_id']. ' の編集';
		define('TEMPLATE' , 'admin/staff/edit.tpl'             );	// テンプレートファイル名
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
