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

class FLConfig
{
	/**
	 * @var	string
	 */
	private $path;
	
	/**
	 * @var	array
	 */
	private $variables;
	
	private $FLErrors;
	
	/**
	 * Load a config file
	 * 
	 * @access	public
	 * @param	strong	$file
	 * @return	
	 */
	public function __construct($file)
	{
		$this->path	=	CONFIG_PATH . $file . '.php';
		
		// Prevents it from being in our list
		unset($file);
		
		// Does the file exist?
		if (!file_exists($this->path))
		{
			// Handle Error
			throw new FLErrors('Could not load config file, the file "' . $this->path . '" could not be found.');
		}
		else
		{
			require($this->path);
			
			// Compile a list of the variables available
			$this->variables	=	get_defined_vars();
		}
	}
	
	/**
	 * Returns a config variable's value
	 * 
	 * @access	public
	 * @param	string	$var
	 * @return	mixed
	 */
	public function setting($var)
	{
		// Check if this variable exists
		if (!array_key_exists($var, $this->variables))
		{
			throw new FLErrors('Config variable does not exist.');
		}
		else
		{
			return $this->variables[$var];
		}
	}
	
	
	/**
	 * THIS WILL INSERT A NEW SETTING INTO THE CONFIG FILE
	 * 
	 * @access	public
	 * @param	string	$setting
	 * @param	mixed	$value
	 * @return	void
	 */
	public function insert($setting, $value)
	{
	}
	
	
	/**
	 * THIS WILL DELETE A SETTING FROM THE CONFIG FILE
	 * 
	 * @access	public
	 * @param	string	$setting
	 * @param	mixed	$value
	 * @return	void
	 */
	public function delete($setting)
	{
	}
	
	/**
	 * THIS WILL REWRITE THE CONFIG FILE WITH THE SETTINGS NEW VALUE
	 * 
	 * @access	public
	 * @param	string	$setting
	 * @param	mixed	$value
	 * @return	void
	 */
	public function change($setting, $value)
	{
		// Chamge permission
		chmod($this->path, 0755);
		
		$handler	=	fopen($this->path, 'w+');
		
		// Did we open the file successfully?
		if ($handler === false)
		{
			FLErrors::handle('core/config', 'An error occured while opening config file to change a setting\'s value.');
		}
		else
		{
			// Does the variable exist?
			if (!array_key_exists($var, $this->variables))
			{
				FLError::handle('core/config', 'Config variable does not exist so we could not change its value.');
			}
			else
			{
				$contents	=	fread($handler, filesize($this->path));
				echo $contents;
			}
		}
		
		// Close File
		fclose($handler);
	}
}