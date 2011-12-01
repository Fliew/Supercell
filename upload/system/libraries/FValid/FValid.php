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
 * @copyright   Copyright (C) 2010 by Fliew. All rights reserved.
 * @license     GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category    FValid
 */

class FValid implements FValidInterface
{
    /**
     * Is this a good number?
     * 
     * @access  public
     * @static
     * @param   string  $number
     * @return  boolean
     */
    public static function phone_number($number)
    {
        if (preg_match('/^(?:1(?:[. -])?)?(?:\((?=\d{3}\)))?([2-9]\d{2})(?:(?<=\(\d{3})\))? ?(?:(?<=\d{3})[.-])?([2-9]\d{2})[. -]?(\d{4})(?: (?i:ext)\.? ?(\d{1,5}))?$/', $number))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * A good URL?
     * 
     * @access  public
     * @static
     * @param   string  $url
     * @return  boolean
     */
    public static function url($url)
    {
        if (preg_match('/^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$/', $url))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Good email address?
     * 
     * @access  public
     * @static
     * @param   string  $email
     * @return  boolean
     */
    public static function email($email)
    {
        if (preg_match('/^([a-z0-9])(([-a-z0-9._+])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', $email))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Valid IP?
     * 
     * @access  public
     * @static
     * @param   string  $ip
     * @return  boolean
     */
    public static function ip($ip)
    {
        if (preg_match('/([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}/', $ip))
        {
            return true;
        }
        else
        {
            /**
             * @todo IP V6
             */
            return false;
        }
    }
    
    /**
     * Is it alphanumeric
     * 
     * @access  public
     * @static
     * @param   string  $string
     * @return  boolean
     */
    public static function alphanumeric($string)
    {
        if (preg_match('/[a-z0-9]/si', $string))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Can be pos or neg and decimal
     * 
     * @access  public
     * @static
     * @param   string  $number
     * @return  boolean
     */
    public static function number($number)
    {
        if (preg_match('/^([+-])*([0-9])+((\.)([0-9])+){0,1}$/', $number))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Allows for everything but [ ] | ; , $ \ < > " '
     * 
     * @access  public
     * @static
     * @param   string  $string
     * @return  boolean
     */
    public static function everything_but($string)
    {
        if (preg_match('/[\[\]|;,$<>"\'\\\]/', $string))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}