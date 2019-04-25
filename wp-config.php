<?php

define('DB_NAME', "db_sentigrate");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_HOST', "localhost");
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY',         'ie&f{SV6~mOgF/q1}F|6<]vk(t-(|^ g:gSyfbRjvB3KF-s/<<MCy&D]/RRP?A!z');
define('SECURE_AUTH_KEY',  '}d=_/ukGbkZhJFirFpR-l+(z*H @$cS/YZMvV$ft589rVK<]f6rWL#~#=iIsT&X_');
define('LOGGED_IN_KEY',    'a<s:;V:cnJ96OU%t?^gc]LudSIFyHRGSN-atvc^->He?,i$Bf]qBBddAaT^D$+8@');
define('NONCE_KEY',        'QG*rKlqH6[jr}P#-wsKp;V>atki!+Q}1&=U;$5O[|7%WEqw,d}<)]%xo2&?dKjGU');
define('AUTH_SALT',        '5d^(T-JX$EuFh@2!+ll/--0|Gg<v}9+CH4S8zma;st![tV;3hSH+QFZBZ--!Qo7U');
define('SECURE_AUTH_SALT', '+v(owNvl(9gi<eapmpK%(k2D$&SV=a)B;wG|DpaquuBek?p@3ct1MBI%+#x8K!QS');
define('LOGGED_IN_SALT',   '] z?>~HWsE9Ns/:8K6TubjV2h&mO5qW%UDMVjS_+e$-9Nzq&%jD/butb`P0v(uxW');
define('NONCE_SALT',       '-EUK*qbm36lwA2vm~)sofsx3t4M|3m3hcBS!OmPSLH`0(gl/3j`| +a+1|7#Ne]%');

$table_prefix = 'nr_';

define('WP_DEBUG', false);
define('WP_POST_REVISIONS', false);
define('UPLOADS', 'assets');
define('DISALLOW_FILE_EDIT', true);
define('NR_SITE_URL', ($_SERVER['HTTPS'] ? 'http://' : 'http://') . $_SERVER['HTTP_HOST']);
define('FORCE_SSL_ADMIN', true);

if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http') { $_SERVER['HTTP'] = 'on'; }
if (!defined('ABSPATH')) { define('ABSPATH', dirname(__FILE__) . '/'); }

define('WP_CONTENT_FOLDERNAME', 'app');
define('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME);
define('WP_CONTENT_URL', NR_SITE_URL . '/sentigrate_final/' . WP_CONTENT_FOLDERNAME);
define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/vendor');
define('WP_PLUGIN_URL', WP_CONTENT_URL . '/vendor');
require_once ABSPATH . 'wp-settings.php';
