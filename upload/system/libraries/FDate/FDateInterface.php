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
 * @category    FDate
 */

interface FDateInterface
{
    /**
     * Creates a European date style
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @static
     * @param   integer $time_stamp
     * @param   string  $divider        What divides the dates
     * @param   boolean $short_day      Shorten the day name
     * @param   boolean $zero           Zero before the date
     * @param   boolean $short_moth     Abbreviate month
     * @param   boolean $short_year     Shorten the year
     * @return  string
     */
    public static function europe($time_stamp, $divider = ', ', $short_day = false, $zero = true, $short_month = false, $short_year = false);
    
    /**
     * Creates a European date style
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @static
     * @param   integer $time_stamp
     * @param   string  $divider        What divides the dates
     * @param   boolean $short_year     Shorten the year
     * @return  string
     */
    public static function europe_num($time_stamp, $divider = '/', $short_year = false);
    
    /**
     * Creates an American numeric date style
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @static
     * @param   integer $time_stamp
     * @param   string  $divider        What divides the dates
     * @param   boolean $zero           Zero before the date
     * @param   boolean $short_moth     Abbreviate month
     * @param   boolean $short_year     Shorten the year
     * @return  string
     */
    public static function american($time_stamp, $divider = ', ', $zero = true, $short_month = false, $short_year = false);
    
    /**
     * Creates a American numeric date style
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @static
     * @param   integer $time_stamp
     * @param   string  $divider        What divides the dates
     * @param   boolean $short_year     Shorten the year
     * @return  string
     */
    public static function american_num($time_stamp, $divider = '/', $short_year = false);
}