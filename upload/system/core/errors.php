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

class FLErrors extends Exception
{
	/**
	 * Exceptions extension
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct($message, $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
	
	/**
	 * Load a config file
	 * 
	 * @access	public
	 * @static
	 * @param	string	$message
	 * @return	
	 */
	public static function handle($where, $message)
	{
		$autoload_config	=	new FLConfig('autoload');
		
		$compiled_message	=	'Error: [' . $where . '] ' . $message;
		
		// Log error message
		FLLog::create('SUPERCELL ERRORS', $compiled_message);
		
		// Display error message
		if ($autoload_config->setting('debug'))
		{
			die('<br /><b>Error: [' . $where . '] ' . $message . '</b><br />');
		}
	}
}