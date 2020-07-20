<?php @session_start();
    date_default_timezone_set ("Asia/Calcutta");
	
    ini_set('display_errors',1);
    define('HTTP_HOST','http://'.$_SERVER['HTTP_HOST'].'/');
	define('HTTP_SERVER', HTTP_HOST.'mopp/'); 
	define('ENABLE_SSL', false);
    define('IS_LIVE',0);
    
    define('SITE_URL', HTTP_HOST.'mopp/');
    
	define('DIR_FS',$_SERVER['DOCUMENT_ROOT'].'/mopp/');
	define('DIR_FS_INCLUDES',DIR_FS.'include/');
    define('DIR_FS_CLASSES',DIR_FS_INCLUDES.'classes/');
	define('DIR_WS_TEMPLATES', DIR_FS.'templates/');
	define('DIR_WS_CONTENT', DIR_WS_TEMPLATES.'content/');
    
    define('SITE_CSS', SITE_URL.'css/');
    define('SITE_JS', SITE_URL.'js/');
    define('SITE_IMAGES', SITE_URL.'images/');
    define('SITE_PLUGINS', SITE_URL.'plugins/');
    
    define('SITE_URL_ADMIN', SITE_URL.'admin/');
	define('DIR_FS_ADMIN',DIR_FS.'admin/');
    define('DIR_WS_TEMPLATES_ADMIN', DIR_WS_TEMPLATES.'admin/');
	define('DIR_WS_CONTENT_ADMIN', DIR_WS_TEMPLATES_ADMIN.'content/');
    
    define('SITE_ADMIN_CSS', SITE_URL_ADMIN.'css/');
    define('SITE_ADMIN_JS', SITE_URL_ADMIN.'js/');
    define('SITE_ADMIN_IMAGES', SITE_URL_ADMIN.'images/');
    define('SITE_ADMIN_PLUGINS', SITE_URL_ADMIN.'plugins/');
    
    define('DIR_IMAGES_ADMIN',DIR_FS.'admin-images/');
    define('SITE_IMAGES_ADMIN',SITE_URL.'admin-images/');
    define('DEFAULT_IMAGE_ADMIN','default.jpg');
    
    define('SMTP_HOST','smtp.gmail.com');
    define('SMTP_ID','noreply.aksham@gmail.com');
    define('SMTP_PASSWORD','aksha1995');
    include(DIR_FS_INCLUDES.'sendmail/class.phpmailer.php');
    include(DIR_FS_INCLUDES.'sendmail/class.smtp.php');
    include(DIR_FS_INCLUDES.'sendmail/PHPMailerAutoload.php');
    
    // local config
	define('DB_SERVER', 'localhost');
	define('DB_SERVER_USERNAME', 'root');
	define('DB_SERVER_PASSWORD', 'Aksh@');
	define('DB_DATABASE', 'mopp');
	define('USE_PCONNECT', 'false');
	define('STORE_SESSIONS', 'mysql');
    
    include(DIR_FS_INCLUDES.'tables.php');
    include(DIR_FS_INCLUDES.'db.class.php');
    include(DIR_FS_INCLUDES.'classes.php');
    include(DIR_FS_INCLUDES.'constants.php');   
    
    $dbins = new db();
?>