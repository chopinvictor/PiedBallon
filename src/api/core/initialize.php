<?php

// DS = directory separator = \ ou /

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// chemin vers le projet en passant par /xampp
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'xampp' . DS . 'htdocs' . DS . '00' . DS . 'PiedBallon');
defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH', SITE_ROOT . DS . 'includes');
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT . DS . 'core');

// chargement des fichiers de config
// require_once(INCLUDE_PATH . "config.php");
require_once('../includes/config.php');
require_once('../core/post.php');

// core classes
// require_once(CORE_PATH.DS. "post.php");

// echo '<pre>';
// echo SITE_ROOT;
// echo '<pre>';
// echo INCLUDE_PATH;
// echo '<pre>';
// echo CORE_PATH;
// echo '<pre>';
