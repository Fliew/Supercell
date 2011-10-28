<?php
/**
 * @author		Fliew
 * @link		http://faintmedia.com
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

interface loadInterface
{
	/**
	 * Load all the standard libraries
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @return	void
	 */
	public static function stdlib();
	
	/**
	 * Load a system library
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name
	 */
	public static function library($name);
	
	/**
	 * Load an application library
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name
	 * @param	boolean	$force_object
	 * @return	void
	 */
	public static function app_library($name, $force_object = false);
}