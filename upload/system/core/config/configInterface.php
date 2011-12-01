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
 * @category	core
 */

interface FConfigInterface
{
	/**
	 * Load a config file
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @param	string	$file
	 * @return	void
	 */
	public function __construct($file);
	
	/**
	 * Returns a config variable's value
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @param	string	$var
	 * @return	mixed
	 */
	public function setting($var);
}