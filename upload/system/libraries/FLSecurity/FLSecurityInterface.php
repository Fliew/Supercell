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
 * @category	FLSecurity
 */

interface FLSecurityInterface
{
	/**
	 * Hash a string
	 * 
	 * @access	public
	 * @static
	 * @param	string	$string
	 * @param	string	$salt
	 * @return	string
	 */
	public static function hash($string, $salt = '');
	
	/**
	 * Creates a random set of characters to be used as password salt
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$min	Min string length
	 * @param	integer	$max	Max string length
	 * @return	string
	 */
	public static function salt($min = '5', $max = '25');
	
	/**
	 * base64 encode for urls
	 * 
	 * @access	public
	 * @static
	 * @param	string	$string
	 * @return	string
	 */
	public static function base64_url_encode($string);
	
	/**
	 * base64 decode for urls
	 * 
	 * @access	public
	 * @static
	 * @param	string	$string
	 * @return	string
	 */
	public static function base64_url_decode($string);
}