<?php
/*** configuration *****/
ini_set('display_errors','on');
error_reporting(E_ALL);
session_start();

class MyAutoload
{
    public static function start()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        
        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];
		//echo "<pre>"; var_dump($_SERVER); exit;
        define('HOST', $_SERVER['REQUEST_SCHEME'].'://'.$host.DIRECTORY_SEPARATOR);
        define('ROOT', $root.DIRECTORY_SEPARATOR);

        define('CONTROLLERS', ROOT.'controllers'.DIRECTORY_SEPARATOR);
        define('VIEWS', ROOT.'views'.DIRECTORY_SEPARATOR);
        define('MODELS', ROOT.'models'.DIRECTORY_SEPARATOR);
        define('CLASSES', ROOT.'classes'.DIRECTORY_SEPARATOR);
        define('OBJECTS', ROOT.'objects'.DIRECTORY_SEPARATOR);
        define('UPOLOADS', ROOT.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR);
        
        define('ASSETS', HOST.'assets'.DIRECTORY_SEPARATOR);
        define('UPOLOAD_URL', HOST.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR);
    }

    public static function autoload($class)
    {
        if(file_exists(MODELS.$class.'.php'))
        {
            include_once (MODELS.$class.'.php');
        } 
        else if (file_exists(CLASSES.$class.'.php'))
        {
            include_once (CLASSES.$class.'.php');
        } 
        else if (file_exists(CONTROLLERS.$class.'.php'))
        {
            include_once (CONTROLLERS.$class.'.php');
        } 
        else if (file_exists(OBJECTS.$class.'.php'))
        {
            include_once (OBJECTS.$class.'.php');
        } 

    }
}




