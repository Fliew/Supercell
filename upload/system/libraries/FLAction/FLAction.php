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
 * @category	FLAction
 */

class FLAction implements FLActionInterface
{
	/**
	 * Get variables
	 * 
	 * @access	public
	 * @return	array
	 */
	public static function get_vars()
	{
		$router	=	new FLRouter;
		
		$locations	=	$router->get_locations();
		$vars_array	=	$router->get_vars($locations['vars'], $locations['vars_begin']);
		
		return $vars_array;
	}
}