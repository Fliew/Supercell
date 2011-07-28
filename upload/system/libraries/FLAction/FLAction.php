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

class FLAction implements FLActionInterface
{
	/**
	 * Get variables
	 * 
	 * @access	public
	 * @return	array
	 */
	public static function get_vars()
	{
		$router	=	new FLRouter;
		
		$locations	=	$router->get_locations();
		$vars_array	=	$router->get_vars($locations['vars'], $locations['vars_begin']);
		
		return $vars_array;
	}
	
	/**
	 * Creates a url with the correct path
	 * 
	 * @access	public
	 * @param	string	$url		ex: test/test
	 * @param	boolean	$fullPath	Include the domain in the address ex: http://fliew.com/
	 * @return	string
	 */
	public static function build_url($url, $full_path = false)
	{
		// Config
		$paths	=	new FLConfig('paths');
		
		$build_url	=	'';
		
		if ($url['0'] != '/')
		{
			$url		=	'/' . $url;
		}
		
		if ($full_path)
		{
			$length	=	strlen(WEB_PATH);
			
			if ($url[$length - 1] == '/')
			{
				$full_path_url	=	substr(WEB_PATH, 0, -1);
			}
			else
			{
				$full_path_url	=	WEB_PATH;
			}
			
			$build_url	.=	$full_path_url;
		}
		
		if ($paths->setting('htaccess') === false)
		{
			$build_url	.=	'index.php';
		}
		
		$build_url	.=	$url;
		$length		=	strlen($build_url);
		
		if ($build_url[$length - 1] == '/')
		{
			$build_url	=	substr($build_url, 0, -1);
		}
		
		return $build_url;
	}
	
	/**
	 * HTML meta redirect
	 * 
	 * @access	public
	 * @param	string	$url
	 * @param	integer	$time
	 * @return	string
	 */
	public static function redirect($url, $time = 0)
	{
		$redirect	=	'<meta http-equiv="refresh" content="' . $time . '; url=' . $path . '" />';
		
		return $redirect;
	}
	
	/**
	 * PHP redirect
	 * 
	 * @access	public
	 * @param	string	$url
	 * @return	void
	 */
	public static function php_redirect($url)
	{
		header('Location: ' . $url);
	}
	
	/**
	 * Gets page data.
	 * Works well for version checks.
	 * 
	 * @access	public
	 * @param	string	$url
	 * @return	string
	 */
	public static function get_url_contents($url)
	{
		if (function_exists('curl_init'))
		{
			// We can use curl
			$ch	=	curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$page	=	curl_exec($ch);

			curl_close($ch);

			return $page;
		}
		else
		{
			die('Supercell System Action Error: Can not use this function because you need CURL installed.');
		}
	}
}