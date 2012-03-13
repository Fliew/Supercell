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

class FConfig implements FConfigInterface
{
    /**
     * @access  private
     * @var     string
     */
    private $path;
    
    /**
     * @access  private
     * @var     array
     */
    private $variables;
    
    /**
     * Load a config file
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @param   string  $file
     * @param
     * @return  void
     */
    public function __construct($file, $location = '')
    {
        if ($location[0] == '/')
        {
            $location = substr($location, 1);
        }
        
        if ($location[strlen($location) - 1] != '/')
        {
            $location = $location . '/';
        }
        
        $this->path = CONFIG_PATH . $location . $file . '.php';
        
        // Prevents it from being in our list
        unset($file);
        
        // Does the file exist?
        if (!file_exists($this->path))
        {
            // Handle Error
            throw new FErrors('Could not load config file, the file "' . $this->path . '" could not be found.');
        }
        else
        {
            require($this->path);
            
            // Compile a list of the variables available
            $this->variables = get_defined_vars();
        }
    }
    
    /**
     * Returns a config variable's value
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @param   string  $var
     * @return  mixed
     */
    public function setting($var)
    {
        // Check if this variable exists
        if (!array_key_exists($var, $this->variables))
        {
            throw new FErrors('Config variable does not exist.');
        }
        else
        {
            return $this->variables[$var];
        }
    }
}