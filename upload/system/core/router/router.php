<?php
/**
 * @author      Fliew
 * @link        http://fliew.com
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

/*
 * Version 2 of FLRouter
 */
class FRouter implements FRouterInterface
{
    /**
     * The default path the the controllers
     * 
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     string
     */
    private $controller_path;
    
    /**
     * Hold the settings for the router.
     * 
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     array
     */
    private $settings;
    
    /**
     * Is the exception thrown to be handled as an error
     * 
     * @access  private
     * @var     boolean
     */
    private $handle_exceptions;
    
    /**
     * Prepare the router
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  void
     */
    public function __construct()
    {
        // Do we want to handle the exception thrown
        $this->handle_exception = true;
        
        // Set default path
        $this->controller_path = SERVER_PATH . 'application/public/controllers/';
        
        // Get settings
        $this->settings = new FConfig('paths');
        
        // Gets our controller and driver
        try
        {
            $url_parts = $this->get_driver();
        }
        catch (FErrors $e)
        {
            // Handle Error
            if ($this->handle_exception)
            {
                $e->handle();
            }
        }
    }
    
    /**
     * Gets the URL path.
     * 
     * @author  Riley Wiebe
     * 
     * @access  private
     * @return  void
     */
    private function get_path()
    {
        $path = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : @getenv('PATH_INFO');
        
        if (!trim($path, '/'))
        {
            //$path = (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');
            
            if (!trim($path, '/'))
            {
                $path = str_replace($_SERVER['SCRIPT_NAME'], '', (isset($_SERVER['ORIG_PATH_INFO'])) ? $_SERVER['ORIG_PATH_INFO'] : @getenv('ORIG_PATH_INFO'));
                
                if (!trim($path, '/'))
                {
                    $path = '';
                    
                    return $path;
                }
                else
                {
                    return $path;
                }
            }
            else
            {
                return $path;
            }
        }
        else
        {
            return $path;
        }
    }
    
    /**
     * Gets the controller and driver
     * 
     * @author  Riley Wiebe
     * 
     * @access  private
     * @return  array
     */
    private function get_driver()
    {
        // The full path
        $path = $this->get_path();
        
        $values = array(
            'controller'    =>  '', // The controller we will look at
            'driver'        =>  '' // The driver that needs to be run
        );
        
        // Check if the path is empty
        if (!trim($path, '/'))
        {
            // Shows the default page.
            $controller['controller'] = $this->settings->setting('default_path');
            $controller['driver'] = $this->settings->setting('default_driver');
        }
        else
        {
            // Remove slash
            $path = trim($path, '/');
            
            // Split path into its parts
            $parts = explode('/', $path);
            
            // Attempt to get our controller
            $controller = $this->get_controller($parts);
        }
        
        // Get the controller file
        require_once($this->controller_path . $controller['controller_directory'] . $controller['controller'] . '.php');
        
        // Create controller object
        $object = new $controller['controller'];
    
        // Do we have the correct driver?
        if (!is_callable(array($object, $controller['possible_driver']), false))
        {
            // Set driver to default
            $driver = $this->settings->setting('default_driver');
            
            // Add to queue
            if (is_array($controller['variables']))
            {
                array_unshift($controller['variables'], $controller['possible_driver']);
            }
            
            // Is the default driver callable?
            if (!is_callable(array($object, $driver), false))
            {
                // No, display error page.
                $error_path = $this->settings->setting('error_path');
                $error_controller = $this->settings->setting('error_controller');
                $driver = $this->settings->setting('error_driver');
                
                require_once($this->controller_path . $error_path . $error_controller . '.php');
                
                $object = new $error_controller;
            }
        }
        else
        {
            // Set driver to our guess
            $driver = $controller['possible_driver'];
        }
        
        // Run driver and passes variables
        $object->$driver($controller['variables']);
        
        return $values;
    }
    
    /**
     * Tries to get the controller and the driver
     * 
     * @author  Riley Wiebe
     * 
     * @access  private
     * @throws  FErrors
     * @param   array   $parts
     * @param   string  $directory      The directory to look for inside controllers
     * @return  array
     */
    private function get_controller($parts, $directories = '')
    {
        // Path to the controllers
        $path = $this->controller_path . $directories;
        
        // Does the current directory exist.
        if (is_dir($path))
        {
            // Check to see if this is the controller
            if (file_exists($path . $parts['0'] . '.php'))
            {
                // Set controller
                $controller = $parts['0'];
                
                // Check if there is another peice in the array
                if (!$parts['1'])
                {
                    // Set the driver to default
                    $possible_driver = $this->settings->setting('default_driver');
                }
                else
                {
                    // Maybe this is our driver, maybe its a variable
                    $possible_driver = $parts['1'];
                }
                
                // Get variables
                array_shift($parts);
                array_shift($parts);
                
                // Returns path to the controller and the possible driver.
                $values = array(
                    'controller'            =>  $controller,
                    'controller_directory'  =>  $directories,
                    'possible_driver'       =>  $possible_driver,
                    'variables'             =>  $parts
                );
                
                return $values;
            }
            else
            {
                // Check to see if parts[0] is a directory
                if (is_dir($path . $parts['0']))
                {
                    if (empty($parts))
                    {
                        $controller['controller_directory'] = $directories;
                        $controller['controller'] = $this->settings->setting('default_driver');
                        
                        if (file_exists($path . $parts['0'] . '.php'))
                        {
                            return $controller;
                        }
                        else
                        {
                            $controller['controller_directory'] = '';
                            $controller['controller'] = 'error';
                        }
                        
                        return $controller;
                    }
                    else
                    {
                        // Check the new directory for the controller.
                        $next_path = $directories . $parts[0] . '/';

                        // Remove the first item in parts, it is no longer needed.
                        $shift_parts = array_shift($parts);

                        $this->before_function = ($this->before_function + 1);

                        $controller = $this->get_controller($parts, $next_path);

                        return $controller;
                    }
                }
                else
                {
                    // Page not found
                    $controller['controller_directory'] = $this->settings->setting('error_path');
                    $controller['controller'] = $this->settings->setting('error_controller');
                    
                    return $controller;
                }
            }
        }
        else
        {
            throw new FErrors('Router error, ' . $path . ' is not a directory.');
        }
    }
}