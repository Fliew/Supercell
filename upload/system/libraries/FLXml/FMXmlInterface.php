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
 * @copyright	Copyright (C) 2010 by Fliew. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category	FLXml
 */

class fm_xml implements fm_xml_interface
{
	/**
	 * Build an RSS file
	 * 
	 * @access	public
	 * @static
	 * @param	string	$title
	 * @param	string	$description
	 * @param	string	$link
	 * @param	integer	$ttl
	 * @param	array	$values
	 * @return	string
	 */
	public static function build($title, $description, $link, $ttl, $values);
}