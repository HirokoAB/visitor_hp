<?php
// -----------------------------------------------------------------------------
//
// /contact.php
//
// 公開画面 お問い合わせ
//
//
// 2018.03.30 作間 新規作成
//
// -----------------------------------------------------------------------------
	try {
		// -----------------------------------------------------
		// 初期設定
		// -----------------------------------------------------
		require_once(realpath(dirname(__FILE__). '/./require.php'));	// 共通ファイル
		define('BODY_ID', 'contact');	// 処理別の識別子

		// -----------------------------------------------------
		// 各処理クラスの読み込み
		// -----------------------------------------------------
		require_once(DATA_PATH. 'class/class.Contact.php');	// お問い合わせ処理クラス
		$classContact = new classContact();

		// -----------------------------------------------------
		// フォーム内容を取得
		// -----------------------------------------------------
		$arrForm = $classUtility->getForm();
		$arrEdit = ($classUtility->isBlank($arrForm['edit'])) ? array(): $arrForm['edit'];

		// -----------------------------------------------------
		// 初期値
		// -----------------------------------------------------
		$now = $classUtility->formatDate('Y/m/d H:i:s');	// 現在時刻

		// -----------------------------------------------------
		// 処理分岐用の設定
		// -----------------------------------------------------
		$arrForm['mode'] = array();
		if (!$classUtility->isBlank($arrForm['button']['edit'    ])) $arrForm['mode'] = 'edit';		// 入力
		if (!$classUtility->isBlank($arrForm['button']['confirm' ])) $arrForm['mode'] = 'confirm';	// 確認
		if (!$classUtility->isBlank($arrForm['button']['send'    ])) $arrForm['mode'] = 'send';		// 送信
		if (!$classUtility->isBlank($arrForm['button']['complete'])) $arrForm['mode'] = 'complete';	// 完了

		// -----------------------------------------------------
		// フォームチェック
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// 確認・送信
			case 'send':
			case 'confirm':
				$arrNotice['error'] = array_merge($arrNotice['error'], $classContact->check($arrEdit, 'send'));
				break;

			// 入力
			default:
				break;
		}
		if (!empty($arrNotice['error'])) $arrForm['mode'] = 'error';

		// -----------------------------------------------------
		// 処理分岐
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// 送信
			case 'send':
				$result = $classContact->send($arrEdit, $arrEdit['mail01'], $arrEdit['name']);
				$classUtility->redirect($_SERVER['SCRIPT_NAME']. (($classUtility->isBlank($_GET)) ? '?': '&'). 'button[complete]=complete');
				break;

			// 完了
			case 'complete':
				break;

			// 確認
			case 'confirm':
				break;

			// 入力
			default:
				break;
		}

		// -----------------------------------------------------
		// テンプレート設定
		// -----------------------------------------------------
		switch ($arrForm['mode']) {

			// 完了
			case 'complete':
				define('SUB_TITLE', 'お問い合わせ'        );	// ページサブタイトル
				define('TEMPLATE' , 'contact/complete.tpl');	// テンプレートファイル名
				break;

			// 確認
			case 'confirm':
				define('SUB_TITLE', 'お問い合わせ'       );	// ページサブタイトル
				define('TEMPLATE' , 'contact/confirm.tpl');	// テンプレートファイル名
				break;

			// 入力
			default:
				define('SUB_TITLE', 'お問い合わせ'     );	// ページサブタイトル
				define('TEMPLATE' , 'contact/index.tpl');	// テンプレートファイル名
				break;
		}

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
	if (!$classUtility->isBlank($arrMaster)) $classSmarty->assign('arrMaster', $arrMaster);	// マスタ配列
	if (!$classUtility->isBlank($arrNotice)) $classSmarty->assign('arrNotice', $arrNotice);	// 通知配列
	if (!$classUtility->isBlank($arrForm  )) $classSmarty->assign('arrForm'  , $arrForm  );	// フォーム内容
	if (!$classUtility->isBlank($arrEdit  )) $classSmarty->assign('arrEdit'  , $arrEdit  );	// 入力内容

	$classSmarty->display_Extends(TEMPLATE);	// テンプレート出力
	exit(0);
?>
