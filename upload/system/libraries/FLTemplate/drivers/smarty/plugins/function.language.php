<?php
/**
 * @author		Faintmedia
 * @link		http://faintmedia.com
 * 
 * @package		Supercell
 * @version		2
 * @link		http://faintmedia.com/supercell
 * @link		http://github.com/Faintmedia/Supercell
 * @since		Supercell: Monday, June 08, 2008
 * @since		Supercell 2: Thursday, March 24, 2011
 * @copyright	Copyright (C) 2010 by Faintmedia. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category	smarty
 */

function smarty_function_language($params, &$smarty)
{
	load::library('FLLanguage');
	
	$string		=	FLLanguage::display($params['var']);
	
    return $string;
}
?>