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
 * @category	FLAction
 */

interface FLActionInterface
{
	/**
	 * Get variables
	 * 
	 * @access	public
	 * @return	array
	 */
	public static function get_vars();
	
	/**
	 * Creates a url with the correct path
	 * 
	 * @access	public
	 * @param	string	$url		ex: test/test
	 * @param	boolean	$fullPath	Include the domain in the address ex: http://fliew.com/
	 * @return	string
	 */
	public static function build_url($url, $full_path = false);
	
	/**
	 * HTML meta redirect
	 * 
	 * @access	public
	 * @param	string	$url
	 * @param	integer	$time
	 * @return	string
	 */
	public static function redirect($url, $time = 0);
	
	/**
	 * PHP redirect
	 * 
	 * @access	public
	 * @param	string	$url
	 * @return	void
	 */
	public static function php_redirect($url);
	
	/**
	 * Gets page data.
	 * Works well for version checks.
	 * 
	 * @access	public
	 * @param	string	$url
	 * @return	string
	 */
	public static function get_url_contents($url);
}