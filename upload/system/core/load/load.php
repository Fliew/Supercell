<?php
/**
 * @author      Fliew
 * @link        http://faintmedia.com
 * 
 * @package     Supercell
 * @version     2
 * @link        http://fliew.com/supercell
 * @link        http://github.com/Fliew/Supercell
 * @since       Supercell: Monday, June 08, 2008
 * @since       Supercell 2: Thursday, March 24, 2011
 * @copyright   Copyright (C) 2010 by Faintmedia. All rights reserved.
 * @license     GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category    core
 */

class load implements loadInterface
{
    /**
     * Load a system library
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @static
     * @param   string  $name
     */
    public static function library($name)
    {
        // File path
        $path = SERVER_PATH . 'system/libraries/' . $name . '/' . $name . '.php';
        
        // Does this library exist?
        if (!file_exists($path))
        {
            // Send error
            throw new FErrors('Library "' . $name . '" not found.');
        }
        else
        {
            $interface = SERVER_PATH . 'system/libraries/' . $name . '/' . $name . 'Interface.php';
            $abstract = SERVER_PATH . 'system/libraries/' . $name . '/' . $name . 'Ibstract.php';
            
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
     * @author  Riley Wiebe
     * 
     * @access  public
     * @static
     * @param   string  $name
     * @param	string	$location
     * @param   boolean $force_object
     * @return  void
     */
    public static function app_library($name, $location = '/', $force_object = false)
    {
        if ($location[0] != '/')
        {
            $location = '/' . $location;
        }
        
        if ($location[strlen($location) - 1] != '/')
        {
            $location = $location . '/';
        }
        
		// Path the library file
		$path = SERVER_PATH . 'application/libraries' . $location . $name;
        $path_file = SERVER_PATH . 'application/libraries' . $location . $name . '.php';
		
		if (!file_exists($path_file))
		{
			// Style two
			$path = SERVER_PATH . 'application/libraries' . $location . $name . '/' . $name;
            $path_file = SERVER_PATH . 'application/libraries' . $location . $name . '/' . $name . '.php';
			
	        if (!file_exists($path_file))
	        {
	            // Send error
	            throw new FErrors('Application library "' . $name . '" not found.');
	        }
		}
		
        $interface = $path . 'Interface.php';
        $abstract = $path . 'Abstract.php';
            
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
        require_once($path_file);
    }
}