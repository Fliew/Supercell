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

class load
{
	/**
	 * Load all the standard libraries
	 * 
	 * @access	public
	 * @return	void
	 */
	public static function stdlib()
	{
		
	}
	
	/**
	 * Load a system library
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name
	 */
	public static function library($name)
	{
		// File path
		$path	=	SERVER_PATH . 'system/libraries/' . $name . '/' . $name . '.php';
		
		// Does this library exist?
		if (!file_exists($path))
		{
			// Send error
			throw new FErrors('Library "' . $name . '" not found.');
		}
		else
		{
			$interface	=	SERVER_PATH . 'system/libraries/' . $name . '/' . $name . 'Interface.php';
			$abstract	=	SERVER_PATH . 'system/libraries/' . $name . '/' . $name . 'Ibstract.php';
			
			// Load interface?
			if (file_exists($interface))
			{
				require_once($interface);
			}
			
			// Load abstract
			if (file_exists($abstract))
			{
				require_once($abstract);
			}
			
			// Found
			require_once($path);
		}
	}
	
	/**
	 * Load an application library
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name
	 * @param	boolean	$force_object
	 * @return	void
	 */
	public static function app_library($name, $force_object = false)
	{
		// File path
		$path	=	SERVER_PATH . 'application/libraries/' . $name . '/' . $name . '.php';
		
		// Does this library exist?
		if (!file_exists($path))
		{
			// Send error
			throw new FErrors('Application library "' . $name . '" not found.');
		}
		else
		{
			$interface	=	SERVER_PATH . 'application/libraries/' . $name . '/' . $name . 'Interface.php';
			$abstract	=	SERVER_PATH . 'application/libraries/' . $name . '/' . $name . 'Abstract.php';
			
			// Load interface?
			if (file_exists($interface))
			{
				require_once($interface);
			}
			
			// Load abstract
			if (file_exists($abstract))
			{
				require_once($abstract);
			}
			
			// Found
			require_once($path);
		}
	}
}