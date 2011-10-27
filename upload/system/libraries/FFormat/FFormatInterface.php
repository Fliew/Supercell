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
 * @copyright	Copyright (C) 2010 by Fliew. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category	FFormat
 */

interface FFormatInterface
{
	/**
	 * Formats a phone number
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$numbers
	 * @return	mixed
	 */
	public static function phone($numbers);
	
	/**
	 * Formats a link
	 * 
	 * @access	public
	 * @static
	 * @param	string	$url
	 * @param	mixed	$www
	 * @param	mixed	$trail_slash
	 * @return	string
	 */
	public static function url($url, $www, $trail_slash);
	
	/**
	 * Chountry code to name
	 * 
	 * @access	public
	 * @static
	 * @param	string	$code
	 * @return	string
	 */
	public static function country($code);
}