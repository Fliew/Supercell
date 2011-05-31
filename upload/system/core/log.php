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

class FLLog
{
	/**
	 * Log information
	 * 
	 * @access	public
	 * @static
	 * @param	string	$filename
	 * @param	string	$message
	 * @return	boolean
	 */
	public static function create($filename, $message)
	{
		$autoload_config	=	new FLConfig('autoload');
		
		if ($autoload_config->setting('logs'))
		{
			$handle	=	fopen(LOGS_PATH . $filename, 'w');
		
			if (!$handle = fopen(LOGS_PATH . $filename, 'w'))
			{
				// Could not open file
				return false;
			}
		
			$message	.=	"\n";
		
			if (fwrite($handle, $message) === false)
			{
				// Could not write to file
				return false;
			}
		
			fclose($handle);
		
			return true;
		}
		else
		{
			return false;
		}
	}
}