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
 * 
 * @category	core
 */

// fm_core_run
class FLRun
{
	/**
	 * Starts the framework
	 * 
	 * @author	Riley Wiebe
	 * @access	public
	 * @return	void
	 */
	public function start()
	{
		if (version_compare(PHP_VERSION, '5.3.0', '<'))
		{
			set_magic_quotes_runtime(0);
		}
		
		if (isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOABLS']))
		{
			exit;
		}
		
		if (isset($_SESSION) && !is_array($_SESSION))
		{
			exit;
		}
		
		// Loads autoload config
		try
		{
			$autoload	=	new FLConfig('autoload');
		}
		catch (FLErrors $e)
		{
			echo $e->handle();
		}
		
		// Set timezone
		date_default_timezone_set($autoload->setting('timezone'));
		
		// Error handling
		if ($autoload->setting('debug') === true)
		{
			if(version_compare(PHP_VERSION, '5.2.0', '>='))
			{
				error_reporting(E_STRICT | E_ERROR | E_WARNING | E_PARSE | E_RECOVERABLE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_USER_WARNING);
			}
			else
			{
				error_reporting(E_STRICT | E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR | E_USER_ERROR | E_USER_WARNING);
			}
		}
		
		// Do we need to start your database connection?
		if ($autoload->setting('database') === true)
		{
			// Start Database Connection
			try
			{
				load::library('FLDatabase');
			}
			catch (FLErrors $e)
			{
				echo $e->handle();
			}
			
			// Load Database Config
			$database	=	new FLConfig('database');
			
			// Try to connect to database
			try
			{
				$connection	=	FLDatabase::connect($database->setting('host'), $database->setting('name'), $database->setting('username'), $database->setting('password'));
			}
			catch (FLErrors $e)
			{
				echo $e->handle();
			}
		}
		
		// Loading pages
		try
		{
			$router	=	new FLRouter(true);
		}
		catch (FLErrors $e)
		{
			echo $e->handle();
		}
		
		// Do we need to close the database connection?
		if ($autoload->setting('database') === true && $database->setting('pconnect') === false)
		{
			// Close the database connection
			FLDatabase::close($connection);
		}
	}
}