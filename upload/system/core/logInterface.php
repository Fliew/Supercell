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

interface FLogInterface
{
	/**
	 * Log information
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @static
	 * @param	string	$filename
	 * @param	string	$message
	 * @param	boolean	$useFErrors
	 * @return	boolean
	 */
	public static function create($filename, $message, $useFErrors = true);
	
	/**
	 * Clear logs
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @static
	 * @param	string	$filename		If left empty we will clear all logs.
	 * @return	void
	 */
	public static function clear_log($filename = '');
}