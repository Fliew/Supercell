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
 * @category    FDatabase
 */

require('mysqlInterface.php');

class mysql implements mysqlInterface
{
    /**
     * Number of queries called
     * 
     * @access  private
     * @static
     * @var     integer
     */
    private static $query_num = 0;
    
    /**
     * Connect to a database
     * 
     * @access  public
     * @param   string  $host
     * @param   string  $name
     * @param   string  $username
     * @param   string  $password
     * @param   boolean $pconnect
     * @return  boolean
     */
    public static function connect($host, $name, $username, $password, $pconnect = false)
    {
        // Load config
        $autoload_config = new FConfig('autoload');
        $database_config = new FConfig('database');
        
        $display_error = $database_config->setting('display_errors');
        $demo_mode = $autoload_config->setting('demo_mode');
        
        // Are we using pconnect?
        if ($pconnect == true)
        {
            if ($display_error == true)
            {
                $connecting = mysql_pconnect($host, $username, $password);
            }
            else
            {
                $connecting = @mysql_pconnect($host, $username, $password);
            }
        }
        else
        {
            if ($display_error == true)
            {
                $connecting = mysql_connect($host, $username, $password);
            }
            else
            {
                $connecting = @mysql_connect($host, $username, $password);
            }
        }
        
        unset($password);
        
        if (!$connecting)
        {
            // There is an error.
            if ($display_error == true)
            {
                throw new FErrors('Database MySQL Driver Error. ' . mysql_error() . ' ' . __FILE__ . ' '. __LINE__);
            }
            else
            {
                throw new FErrors('Database MySQL Driver Error. ' . mysql_error() . ' ' . __FILE__ . ' '. __LINE__);
            }
        }
        
        $select = mysql_select_db($name);
        
        if (!$select)
        {
            // There is an error.
            if ($return_error == '1')
            {
                throw new FErrors('Database MySQL Driver Error. ' . mysql_error() . ' ' . __FILE__ . ' '. __LINE__);
            }
            else
            {
                throw new FErrors('Database MySQL Driver Error. ' . mysql_error() . ' ' . __FILE__ . ' '. __LINE__);
            }
        }
        else
        {
            return $connecting;
        }
        
        return false;
    }
    
    /**
     * Close a MySQL connection
     * 
     * @access  public
     * @param   string  $var
     * @return  void
     */
    public static function close($var)
    {
        mysql_close($var);
    }
    
    /**
     * MySQL query
     * 
     * @access  public
     * @param   string  $query
     * @param   boolean $demo_override  Query will run even if in demo mode
     * @return  mixed
     */
    public static function query($query, $demo_override = false)
    {
        // Load config
        $autoload_config = new FConfig('autoload');
        $database_config = new FConfig('database');
        
        $display_error = $database_config->setting('display_errors');
        $demo_mode = $autoload_config->setting('demo_mode');
        
        if ($demo_mode == true && $demo_override === false)
        {
            // We are running display mode.
            if (preg_match('/$([INSERT\s+INTO]|[UPDATE]|[DELETE])/si', $query))
            {
                return false;
            }
        }
        
        // Attempts to run query.
        $run = mysql_query($query);
        
        // Is there an error?
        if (!$run)
        {
            // There is an error.
            if ($display_error == true)
            {
                throw new FErrors('Database MySQL Driver Error. ' . mysql_error() . ' ' . __FILE__ . ' '. __LINE__);
            }
            else
            {
                throw new FErrors('Database MySQL Driver Error. ' . mysql_error() . ' ' . __FILE__ . ' '. __LINE__);
            }
        }
        
        self::$query_num = self::$query_num + 1;
        
        return $run;
    }
    
    /**
     * Returns the number of MySQL queries
     * 
     * @access  public
     * @return  integer
     */
    public static function num_queries()
    {
        return self::$query_num;
    }
}