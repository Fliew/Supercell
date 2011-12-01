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

interface FValidInterface
{
    /**
     * Is this a good number?
     * 
     * @access  public
     * @static
     * @param   string  $number
     * @return  boolean
     */
    public static function phone_number($number);
    
    /**
     * A good URL?
     * 
     * @access  public
     * @static
     * @param   string  $url
     * @return  boolean
     */
    public static function url($url);
    
    /**
     * Good email address?
     * 
     * @access  public
     * @static
     * @param   string  $email
     * @return  boolean
     */
    public static function email($email);
    
    /**
     * Valid IP?
     * 
     * @access  public
     * @static
     * @param   string  $ip
     * @return  boolean
     */
    public static function ip($ip);
    
    /**
     * Is it alphanumeric
     * 
     * @access  public
     * @static
     * @param   string  $string
     * @return  boolean
     */
    public static function alphanumeric($string);
    
    /**
     * Can be pos or neg and decimal
     * 
     * @access  public
     * @static
     * @param   string  $number
     * @return  boolean
     */
    public static function number($number);
    
    /**
     * Allows for everything but [ ] | ; , $ \ < > " '
     * 
     * @access  public
     * @static
     * @param   string  $string
     * @return  boolean
     */
    public static function everything_but($string);
}