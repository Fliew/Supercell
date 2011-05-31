<?php
/**
 * @author		Faintmedia
 * @link		http://faintmedia.com
 * 
 * @package		Supercell
 * @version		2
 * @link		http://faintmedia.com/supercell
 * @link		http://github.com/Fliew/Supercell
 * @since		Supercell: Monday, June 08, 2008
 * @since		Supercell 2: Thursday, March 24, 2011
 * @copyright	Copyright (C) 2010 by Faintmedia. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @subpackage	FLDatabase
 */

class FLDatabase implements FLDatabaseInterface
{
	/**
	 * @access	private
	 * @var		string
	 */
	private static $driver;
	
	/**
	 * If you want to use a different database driver than set in the config
	 * create the database as an object, and set the database driver in the constructor
	 * 
	 * $different_database	=	load::library('fm_database', true);
	 * 
	 * @access	public
	 * @param	string	$driver
	 * @return	void
	 */
	public function __construct($driver)
	{
		self::$driver	=	$driver;
	}
	
	private static function call($name, $params)
	{
		// Loads driver
		if (!self::$driver)
		{
			// Loads config driver
			$config	=	new FLConfig('database');
			
			// Sets the driver for later use
			self::$driver	=	$config->setting('driver');
			
			require_once(SERVER_PATH . 'system/libraries/FLDatabase/drivers/' . self::$driver . '.php');
		}
		else
		{
			// Call constructor driver
			require_once(SERVER_PATH . 'system/libraries/FLDatabase/drivers/' . self::$driver . '.php');
		}
		
		// Grabs the parameters
		$class	=	self::$driver;
		return call_user_func_array("$class::$name", $params);
	}
	
	/**
	 * Connect to a database
	 * 
	 * @access	public
	 * @static
	 * @return	boolean
	 */
	public static function connect(/* Parameters */)
	{
		$params	=	func_get_args();
		
		return self::call('connect', $params);
	}
	
	/**
	 * Close a MySQL connection
	 * 
	 * @access	public
	 * @param	string	$var
	 * @return	void
	 */
	public static function close(/* Parameters */)
	{
		$params	=	func_get_args();
		
		return self::call('close', $params);
	}
	
	/**
	 * Close a connection
	 * 
	 * @access	public
	 * @static
	 * @return	mixed
	 */
	public static function query(/* Parameters */)
	{
		$params	=	func_get_args();
		
		return self::call('query', $params);
	}
	
	/**
	 * Close a connection
	 * 
	 * @access	public
	 * @static
	 * @return	integer
	 */
	public static function num_queries(/* Parameters */)
	{
		$params	=	func_get_args();
		
		return self::call('num_queries', $params);
	}
}