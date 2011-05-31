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
 * @category	FLDatabase
 */

interface mysqlInterface
{
	/**
	 * Connect to a database
	 * 
	 * @access	public
	 * @param	string	$host
	 * @param	string	$name
	 * @param	string	$username
	 * @param	string	$password
	 * @param	boolean	$pconnect
	 * @return	void
	 */
	public static function connect($host, $name, $username, $password, $pconnect = false);
	
	/**
	 * MySQL query
	 * 
	 * @access	public
	 * @param	string	$query
	 * @param	boolean	$demo	If you are running in demo mode no insert, update or delete queries will run.
	 * @return	void
	 */
	public static function query($query, $demo_override = false);
	
	/**
	 * Close a MySQL connection
	 * 
	 * @access	public
	 * @param	string	$var
	 * @return	void
	 */
	public static function close($var);
	
	/**
	 * Returns the number of MySQL queries
	 * 
	 * @access	public
	 * @return	integer
	 */
	public static function num_queries();
}