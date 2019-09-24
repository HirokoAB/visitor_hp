<?php
// -----------------------------------------------------------------------------
//
// /admin/index.php
//
// 管理画面 ログイン
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
		define('BODY_ID', 'index');	// 処理別の識別子

		// -----------------------------------------------------
		// フォーム内容を取得
		// -----------------------------------------------------
		$arrForm = $classUtility->getForm();
		$arrForm['mode'] = (!empty($arrForm['mode'])) ? $arrForm['mode'] : $arrForm['mode'] = '';	// 動作モード

		// -----------------------------------------------------
		// フォームチェック
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// エラー処理
			case 'error':
				break;

			// ログアウト処理
			case 'logout':
				break;

			// ログイン処理
			case 'login':
				if (false == $classUtility->tokenCheck($arrForm['token'], 'admin')) {
					$arrNotice['error'][] = $arrMaster['http_status_code'][400][0];
					$arrNotice['error'][] = $arrMaster['http_status_code'][400][1];
				} else {
					$classAuth->login_id   = $arrForm['login']['id'  ];
					$classAuth->login_pass = $arrForm['login']['pass'];
					if ($classUtility->isBlank($classAuth->login_id) || $classUtility->isBlank($classAuth->login_pass)) {
						$arrNotice['error'][] = 'ログインID / パスワードを入力してください';
					} else if (!$classAuth->login()) {
						$arrNotice['error'][] = 'ログインIDまたはパスワードが正しくありません';
					}
				}
				break;

			default:
				break;
		}
		if (!empty($arrNotice['error'])) $arrForm['mode'] = '';

		// -----------------------------------------------------
		// 処理分岐
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// エラー処理
			case 'error':
				$arrLogin = $_SESSION['admin'];
				throw new Exception($arrForm['code']);
				break;

			// ログアウト処理
			case 'logout':
				$classAuth->logout();
				$classUtility->redirect(ADMIN_URL);
				break;

			// ログイン処理
			case 'login':
				break;

		    default:
				break;
		}

		// -----------------------------------------------------
		// ログインチェック
		// -----------------------------------------------------
		if ($classAuth->check()) $classUtility->redirect(ADMIN_URL. 'info/');

		// -----------------------------------------------------
		// 外部ファイル設定
		// -----------------------------------------------------
		$arrInclude = [
			'css' => ['css/contents/index.css'],
			'js'  => ['js/contents/index.js'  ],
		];

		// -----------------------------------------------------
		// テンプレート設定
		// -----------------------------------------------------
		define('SUB_TITLE', 'ログイン'                         );	// ページサブタイトル
		define('TEMPLATE' , 'admin/index.tpl'                  );	// テンプレートファイル名
		define('TOKEN'    , $classUtility->tokenCreate('admin'));	// ワンタイムトークン

	} catch (Exception $e) {
		$arrResult = $classUtility->error($e->getMessage());
		$arrNotice['error'] = $arrResult['error'];
		define('TEMPLATE' , $arrResult['template' ]);	// テンプレートファイル名
		define('SUB_TITLE', $arrResult['sub_title']);	// ページサブタイトル
		$arrResult = $classUtility->header($e->getMessage());
	}

	// -----------------------------------------------------
	// Smarty出力
	// -----------------------------------------------------
	if (!$classUtility->isBlank($arrMaster )) $classSmarty->assign('arrMaster' , $arrMaster );	// マスタ配列
	if (!$classUtility->isBlank($arrNotice )) $classSmarty->assign('arrNotice' , $arrNotice );	// 通知配列
	if (!$classUtility->isBlank($arrLogin  )) $classSmarty->assign('arrLogin'  , $arrLogin  );	// ログイン管理者情報
	if (!$classUtility->isBlank($arrInclude)) $classSmarty->assign('arrInclude', $arrInclude);	// 外部読み込みファイル
	if (!$classUtility->isBlank($arrForm   )) $classSmarty->assign('arrForm'   , $arrForm   );	// フォーム内容

	$classSmarty->display_Extends(ADMIN_FRAME);	// テンプレート出力
	exit(0);
?>

