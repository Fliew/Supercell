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
 * @category	FDatabase
 */

// Check the driver interfaces to learn what values to enter in /* parameter */ tags

interface FDatabaseInterface
{
	/**
	 * Connect to a database
	 * 
	 * @access	public
	 * @static
	 * @return	boolean
	 */
	public static function connect(/* Parameters */);
	
	/**
	 * Close a connection
	 * 
	 * @access	public
	 * @static
	 * @return	boolean
	 */
	public static function query(/* Parameters */);
	
	/**
	 * Close a connection
	 * 
	 * @access	public
	 * @param	string	$var
	 * @return	void
	 */
	public static function close(/* Parameters */);
	
	/**
	 * Close a connection
	 * 
	 * @access	public
	 * @static
	 * @return	integer
	 */
	public static function num_queries(/* Parameters */);
}