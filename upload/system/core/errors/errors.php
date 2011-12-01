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

class FErrors extends Exception implements FErrorsInterface
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
     * Exceptions extension
     * 
     * @access  public
     * @return  void
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        if (version_compare(phpversion(), '5.3.0') >= 0)
        {
            parent::__construct($message, $code, $previous);
        }
        else
        {
            parent::__construct($message, $code);
        }
        
        $this->path = CONFIG_PATH . 'autoload.php';
        
        // Does the file exist?
        if (!file_exists($this->path))
        {
            die('application/config/autoload.php not found.');
        }
        else
        {
            require($this->path);
            
            // Compile a list of the variables available
            $this->variables = get_defined_vars();
        }
    }
    
    /**
     * Private config function since config uses this class to throw exceptions
     * 
     * @access  private
     * @return  string
     */
    private function setting($var)
    {
        // Check if this variable exists
        if (!array_key_exists($var, $this->variables))
        {
            die('Variable does not exist in errors.php');
        }
        else
        {
            return $this->variables[$var];
        }
    }
    
    /**
     * Handle the errors
     * 
     * @access  public
     * @return  void
     */
    public function handle()
    {
        if ($this->setting('logs'))
        {
            // Log error
            $log_message = date('r',time()) . "\n"
                            . 'Message: ' . parent::getMessage() . "\n"
                            . 'Code: ' . parent::getCode() . "\n"
                            . 'File: ' . parent::getFile() . "\n"
                            . 'Line: ' . parent::getLine() . "\n"
                            . 'Trace: ' . "\n" . parent::getTraceAsString() . "\n";
            
            FLog::create('SupercellErrors.log', $log_message);
        }
        
        if ($this->setting('debug'))
        {
            // Display error
            $display_message = '<b>Supercell Error:</b>' . "\n" . '<br />' . "\n"
                                . 'Message: ' . parent::getMessage() . "\n" . '<br />' . "\n"
                                . 'Code: ' . parent::getCode() . "\n" . '<br />' . "\n"
                                . 'File: ' . parent::getFile() . "\n" . '<br />' . "\n"
                                . 'Line: ' . parent::getLine() . "\n" . '<br />' . "\n"
                                . 'Trace: ' . "\n" . '<br />' . "\n"
                                . str_replace("\n", "\n" . '<br />' . "\n", parent::getTraceAsString()) . "\n" . '<br />' . "\n";
            
            echo $display_message;
        }
    }
}