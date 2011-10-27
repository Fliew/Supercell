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

class FTemplate implements FTemplateInterface
{
	/**
	 * @access	public
	 * @var		mixed
	 */
	public $smarty;
	
	/**
	 * Loads our template data
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		// Settings
		$autoload_config	=	new FConfig('autoload');
		$template_config	=	new FConfig('template');
		$cache_config		=	new FConfig('cache');
		
		// Get smarty libs
		require_once(SERVER_PATH . '/system/libraries/FTemplate/drivers/smarty/Smarty.class.php');
		
		$this->smarty	=	new Smarty();
		
		$this->smarty->template_dir	=	$template_config->setting('template');
		$this->smarty->compile_dir	=	$template_config->setting('compile_dir');
		$this->smarty->cache_dir	=	$template_config->setting('cache_dir');
		
		// Caching?
		$this->smarty->caching			=	$cache_config->setting('template_caching');
		$this->smarty->cache_lifetime	=	$cache_config->setting('template_ttl');
		
		// Development mode?
		if ($autoload_config->setting('dev_mode'))
		{
			// Clears all compile files for instant changes.
			$this->smarty->clear_compiled_tpl();
		}
	}
}