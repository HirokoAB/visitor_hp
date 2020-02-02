<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'ae136g4cz2_20160829');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'ae136g4cz2');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'jixUHJ5V');

/** MySQL のホスト名 */
define('DB_HOST', '127.0.0.1:3307');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-l1)%[uGz2]!7nh9?/A~-i8+;H8E:7^jmS/o>-nB=L8,0xgyaznGak,C`MCV*VFJ');
define('SECURE_AUTH_KEY',  'qC[6=S9FE&fivN=5)b<4~S;gs/[Cy|Z8}iX?((n!hvv%>i7[6^pm<G^V.Fc!b=b5');
define('LOGGED_IN_KEY',    'PtQ25P9oPYbv?U_OaV_N`>1?d0*1(SWw26=Xcg~=jZZuC:a<~tMJ}kDo1e:d-tNc');
define('NONCE_KEY',        '-~@k+fB6qg[f5%Gl_{?Mebkd6>FUZicbNKep{,nlguNtykv0j!|)arO>uU(X&GM7');
define('AUTH_SALT',        '5I_bbt8/XX,92tUC-.Cr<F1u=HpVlKy`>g.@P4D- [wjs.A13*d|+U~.I5Pwb}?z');
define('SECURE_AUTH_SALT', 'Ue=VgM9H|t6Wo%LK+?OLBbd`/+z{Z~XU>D4->)._qHeXUNpR=fhGJuO=0<.&G-W_');
define('LOGGED_IN_SALT',   ',Jr>*97GVtj^pia,BL$V[>=im^-zWs~JQV<}-^x||gwO?`hR<|1|XIhci(=x)G<e');
define('NONCE_SALT',       'ZG?Ir cchv`2[OJH?8+KL~5Q:f)ac2V378o8x-uT$O&XsB2U*GbOAh)^h-iMznw@');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
