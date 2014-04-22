<?php
# Database Configuration
define('DB_NAME','snapshot_tekserve');
define('DB_USER','tekserve');
define('DB_PASSWORD','hCQ1kO5ixoVUBxionCLS');
define('DB_HOST','127.0.0.1');
define('DB_HOST_SLAVE','127.0.0.1');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '+V1&a!>t)W:CcD>RPo^.|g2Dj-iX=fofR4](-%#qR^n:FAIl|N:#g9Z2UqzSc-lV');
define('SECURE_AUTH_KEY',  'bHQ9M3Dt{__{~s-%drL-{zJtiJl}Pn5|@4dBQgr&(HPgekIZJo69p#$~.+=:(y?~');
define('LOGGED_IN_KEY',    ':DJ/2hs)rob4%FJ/@B%+@=bX>9;uWZq3PlWc+C&U<|%aXv{?JJ_s[N@53^03-;iM');
define('NONCE_KEY',        'ou@$fUA8~NfXZ5fJa9S.!$4n}<,B6[qaouyb7nRlUPGp0QvL|eHrhVLMv)>Ji[1G');
define('AUTH_SALT',        '~xtbiF/dlTfzeOX+!Bo5iw-,Z x|}r0tl?5ElbTJ_V(D?!3b7)+1 3m:7q6hdya+');
define('SECURE_AUTH_SALT', '1,68#vE=cM5Jt?v5ZPI#)zC}f$PCM@z>]-+u;pSB+No *:q([7;f@-(O^F278g&a');
define('LOGGED_IN_SALT',   'uw&zu`=-n!*Q75LuO.fAq7n|l&oL[*(v9Z`],ZaHf8|VwzuV-++|E=*+y,v|ps?`');
define('NONCE_SALT',       '_v67DDUYcM0FMX9YBS1`1>6Gj%Q3S+ 2|-4c%-!j-FU?7$Xe}kIK7JmTk+Z||UF5');


# Localized Language Stuff

define('WP_CACHE',TRUE);

define('PWP_NAME','tekserve');

define('FS_METHOD','direct');

define('FS_CHMOD_DIR',0775);

define('FS_CHMOD_FILE',0664);

define('PWP_ROOT_DIR','/nas/wp');

define('WPE_APIKEY','8d08bbbf7b8627bf2addd0229d854521217867fe');

define('WPE_FOOTER_HTML',"");

define('WPE_CLUSTER_ID','2027');

define('WPE_CLUSTER_TYPE','pod');

define('WPE_ISP',true);

define('WPE_BPOD',false);

define('WPE_RO_FILESYSTEM',false);

define('WPE_LARGEFS_BUCKET','largefs.wpengine');

define('WPE_CDN_DISABLE_ALLOWED',false);

define('DISALLOW_FILE_EDIT',FALSE);

define('DISALLOW_FILE_MODS',FALSE);

define('DISABLE_WP_CRON',false);

define('WPE_FORCE_SSL_LOGIN',false);

define('FORCE_SSL_LOGIN',false);

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define('WPE_EXTERNAL_URL',false);

define('WP_POST_REVISIONS',FALSE);

define('WPE_WHITELABEL','wpengine');

define('WP_TURN_OFF_ADMIN_BAR',false);

define('WPE_BETA_TESTER',false);

umask(0002);

$wpe_cdn_uris=array ();

$wpe_no_cdn_uris=array ();

$wpe_content_regexs=array ();

$wpe_all_domains=array (  0 => 'faq.tekserve.com',  1 => 'tekserve.wpengine.com',);

$wpe_varnish_servers=array (  0 => 'pod-2027',);

$wpe_ec_servers=array ();

$wpe_largefs=array ();

$wpe_netdna_domains=array (  0 =>   array (    'match' => 'tekserve.wpengine.com',    'zone' => '3civ7q19xq3z4d2wi812e1iujkj',  ),  1 =>   array (    'match' => 'faq.tekserve.com',    'zone' => 'n7igo4dfehm26whe51igur5adp',  ),);

$wpe_netdna_push_domains=array ();

$wpe_domain_mappings=array ();

$memcached_servers=array (  'default' =>   array (    0 => 'unix:///tmp/memcached.sock',  ),);

//define('WP_SITEURL','http://tekserve.staging.wpengine.com');

//define('WP_HOME','http://tekserve.staging.wpengine.com');

define('WP_AUTO_UPDATE_CORE',false);

$wpe_special_ips=array ();

$wpe_netdna_domains_secure=array ();
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
