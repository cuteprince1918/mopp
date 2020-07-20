<?php
    define('APP_TBL_PREFIX','pw_');
    
    define('DIR_WS_USERS',DIR_FS.'users/');
    define('SITE_USERS',SITE_URL.'users/');
    
    define('DIR_WS_UPLOAD',DIR_FS.'upload/');
    define('SITE_UPLOAD',SITE_URL.'upload/');
    
    define('DEFAULT_URSER_IMAGE','default.jpg');
    
    define('CURRENT_FILE',basename($_SERVER['SCRIPT_FILENAME']));
    define('CURRENT_PAGE',HTTP_HOST.ltrim(parse_url($_SERVER['REQUEST_URI'])['path'],'/'));
    
    define('CURRENT_PAGE_QRY',trim(CURRENT_PAGE.'?'.$_SERVER['QUERY_STRING'],'?'));
    define('CURRENT_DATETIME',date('Y-m-d H:i:s'));
    
    define('STATUS_MESSAGE','Status changed successfully.');
    define('DELETE_MESSAGE','Record deleted successfully.');
    define('DELETE_IMAGE_MESSAGE','Image deleted successfully.');
    define('INSERT_MESSAGE','Record inserted successfully.');
    define('UPDATE_MESSAGE','Record updated successfully.');
    define('UNKWON_ERROR','Something went wrong, please try again.');
	
	define('PASSWORD_UPDATE_SUCCESS','Your password updated successfully.');
    
    /* encryption */
    define('SECRET_KEY','lx.kCe@%D');
    define('SECRET_IV','Kuc&*sX$2x');
    
    /*trash days limit for note display:*/
    define('TRASH_DAYS_LIMIT',30);
?>