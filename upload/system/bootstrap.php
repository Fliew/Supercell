<?php
/**
 * @author		Fliew
 * @link		http://fliew.com
 * 
 * @package		Supercell
 * @version		2
 * @link		http://fliew.com/supercell
 * @link		http://github.com/Fliew/Supercell
 * @since		Supercell: Monday, June 08, 2008
 * @since		Supercell 2: Thursday, March 24, 2011
 * @copyright	Copyright (C) 2010 by Faintmedia. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 */

// Is this defined?
if (!defined('SUPERCELL_FRAMEWORK'))
{
	exit;
}

// Define paths
define('SERVER_PATH', dirname(dirname(__FILE__)) . '/', DIRECTORY_SEPARATOR);

$link_path	=	$_SERVER['PHP_SELF'];
explode('index.php', $link_path);
define('LINK_PATH', $link_path[0]);

// Getting web path
$web_path	=	'http';

if (!empty($_SERVER['HTTPS']))
{
	$web_path	.=	's';
}

$web_path	.=	'://';

$web_path	.=	$_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

$length		=	(strlen($_SERVER['REQUEST_URI']) - 1);

if ($_SERVER['REQUEST_URI'][$length] == '/')
{
	$web_path	.=	'/';
}

$web_path	=	explode('index.php', $web_path);

$web_path	=	$web_path[0];

define('WEB_PATH', $web_path);

// Constant Paths
define('CONFIG_PATH', SERVER_PATH . 'application/config/');
define('CACHE_PATH', SERVER_PATH . 'application/cache/');
define('LOGS_PATH', SERVER_PATH . 'application/logs/');

// Core Files
require(SERVER_PATH . 'system/core/log.php');
require(SERVER_PATH . 'system/core/errors.php');
require(SERVER_PATH . 'system/core/config.php');
require(SERVER_PATH . 'system/core/load.php');
require(SERVER_PATH . 'system/core/router.php');
require(SERVER_PATH . 'system/core/run.php');

FLRun::start();