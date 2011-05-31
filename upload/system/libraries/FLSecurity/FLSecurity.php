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

class FLSecurity implements FLSecurityInterface
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
	public static function hash($string, $salt = '')
	{
		if (!$salt)
		{
			// No salt at all
			$hash	=	md5(sha1(md5(sha1($string))));
			
			return $hash;
		}
		else
		{
			// They are using salt.
			$hash	=	md5(sha1(sha1(md5($salt)) . md5(sha1($string)) . md5(sha1($salt))));
			
			return $hash;
		}
	}
	
	/**
	 * Creates a random set of characters to be used as password salt
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$min	Min string length
	 * @param	integer	$max	Max string length
	 * @return	string
	 */
	public static function salt($min = '5', $max = '25')
	{
		// Well that doesn't make any sense...
		if ($min > $max)
		{
			FLErrors::handle('fm_security salt', 'Min length was larger than max.');
		}
		else
		{
			$selection	=	'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890`~!@#$%^&*()-_=+[{}]\|;:,<.>/?';

			$salt		=	'';

			$rand		=	rand($min, $max);

			for ($i = 0; $i < $rand; $i++)
			{
				$salt	.=	$selection[rand(0, 94)];
			}

			return addslashes($salt);
		}
	}
	
	/**
	 * base64 encode for urls
	 * 
	 * @access	public
	 * @static
	 * @param	string	$string
	 * @return	string
	 */
	public static function base64_url_encode($string)
	{
		return strtr(base64_encode($string), '+/=', '-_');
	}
	
	/**
	 * base64 decode for urls
	 * 
	 * @access	public
	 * @static
	 * @param	string	$string
	 * @return	string
	 */
	public static function base64_url_decode($string)
	{
		return base64_decode(strtr($strig, '-_', '+/='));
	}
}