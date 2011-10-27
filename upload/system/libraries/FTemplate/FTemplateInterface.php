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
 * @subpackage	FTemplate
 * @link		http://www.smarty.net/documentation
 */

interface FTemplateInterface
{
	/**
	 * @access	public
	 * @var		mixed
	 */
	//public $smarty;
	
	/**
	 * Loads our template data
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct();
}