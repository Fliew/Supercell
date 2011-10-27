<?php
/**
 * @author		Fliew
 * @link		http://fliew.com
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
 * @category	FDate
 */

class FDate implements FDateInterface
{
	/**
	 * Creates a European date style
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$time_stamp
	 * @param	string	$divider		What divides the dates
	 * @param	boolean	$short_day		Shorten the day name
	 * @param	boolean	$zero			Zero before the date
	 * @param	boolean	$short_moth		Abbreviate month
	 * @param	boolean	$short_year		Shorten the year
	 * @return	string
	 */
	public static function europe($time_stamp, $divider = ', ', $short_day = false, $zero = true, $short_month = false, $short_year = false)
	{
		// Day
		$day_name	=	($short_day === true) ? 'D' : 'l';
		$day_number	=	($zero === true) ? 'd' : 'j';
	
		// Month
		$month		=	($short_month === true) ? 'M' : 'F';
	
		// Year
		$year		=	($short_year === true) ? 'y' : 'Y';
	
		$date		=	date($day_name . $divider . $month . ' ' . $day_number . $divider . $year, $time_stamp);
	
		return $date;
	}

	/**
	 * Creates a European date style
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$time_stamp
	 * @param	string	$divider		What divides the dates
	 * @param	boolean	$short_year		Shorten the year
	 * @return	string
	 */
	public static function europe_num($time_stamp, $divider = '/', $short_year = false)
	{
		$year	=	($short_year === true) ? 'y' : 'Y';
		$date	=	date('d' . $divider . 'm' . $divider . $year, $time_stamp);
	
		return $date;
	}

	/**
	 * Creates an American numeric date style
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$time_stamp
	 * @param	string	$divider		What divides the dates
	 * @param	boolean	$zero			Zero before the date
	 * @param	boolean	$short_moth		Abbreviate month
	 * @param	boolean	$short_year		Shorten the year
	 * @return	string
	 */
	public static function american($time_stamp, $divider = ', ', $zero = true, $short_month = false, $short_year = false)
	{
		// Day
		$day_number	=	($zero === true) ? 'd' : 'j';
	
		// Month
		$month		=	($short_month === true) ? 'M' : 'F';
	
		// Year
		$year		=	($short_year === true) ? 'y' : 'Y';
	
		$date		=	date($month . ' ' .  $day_number . $divider . $year, $time_stamp);
	
		return $date;
	}

	/**
	 * Creates a American numeric date style
	 * 
	 * @access	public
	 * @static
	 * @param	integer	$time_stamp
	 * @param	string	$divider		What divides the dates
	 * @param	boolean	$short_year		Shorten the year
	 * @return	string
	 */
	public static function american_num($time_stamp, $divider = '/', $short_year = false)
	{
		$year	=	($short_year === true) ? 'y' : 'Y';
		$date	=	date('m' . $divider . 'd' . $divider . $year, $time_stamp);
	
		return $date;
	}
}