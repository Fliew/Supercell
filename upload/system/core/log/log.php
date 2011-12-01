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

class FLog implements FLogInterface
{
    /**
     * Log information
     * 
     * @access  public
     * @static
     * @param   string  $filename
     * @param   string  $message
     * @param   boolean $useFErrors
     * @return  boolean
     */
    public static function create($filename, $message, $useFErrors = true)
    {
        $autoload_config = new FConfig('autoload');
        
        if ($autoload_config->setting('logs'))
        {
            if (file_exists(LOGS_PATH . $filename))
            {
                $temp_message = $message;
                $message = file_get_contents(LOGS_PATH . $filename);
                $message .= $temp_message;
            }
            
            $handle = fopen(LOGS_PATH . $filename, 'w');
        
            if (!$handle = fopen(LOGS_PATH . $filename, 'w'))
            {
                // Could not open file
                if ($useFErrors)
                {
                    throw new FErrors('Could not open file ' . $filename);
                }
                
                return false;
            }
            
            $message .= "\n";
            
            if (fwrite($handle, $message) === false)
            {
                // Could not write to file
                if ($useFErrors)
                {
                    throw new FErrors('Could not write to file ' . $filename);
                }
                
                return false;
            }
        
            fclose($handle);
        
            return true;
        }
        else
        {
            // We are not logging
            return false;
        }
    }
    
    /**
     * Clear logs
     * 
     * @access  public
     * @static
     * @param   string  $filename       If left empty we will clear all logs.
     * @return  void
     */
    public static function clear_log($filename = '')
    {
        if (!$filename)
        {
            // Delete all files
            foreach (glob(LOGS_PATH . '*') as $file)
            {
                unlink($file);
            }
        }
        else
        {
            unlink(LOGS_PATH . $filename);
        }
    }
}