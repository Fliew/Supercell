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

class FLRouter
{
	/**
	 * @var	string
	 */
	private $settings;
	
	/**
	 * Router constructor
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct($init = false)
	{
		// Settings
		$this->settings	=	new FLConfig('paths');
		
		$locations	=	$this->get_locations();
		
		if ($init === true)
		{
			if (isset($locations['controller']) && isset($locations['function']))
			{
				$this->controller($locations['controller'], $locations['function']);
			}
		}
	}
	
	/**
	 * Handles error page
	 * 
	 * @access	public
	 * @return	void
	 */
	public function error()
	{
		$error_path	=	$this->settings->setting('error_path');
		
		if (!file_exists(SERVER_PATH . 'application/public/controllers/' . $error_path . '.php'))
		{
			throw new FLErrors('Error page not found.');
		}
		else
		{
			require_once(SERVER_PATH . 'application/public/controllers/' . $error_path . '.php');
			
			$location	=	$this->settings->setting('default_location');
			
			$error_path	=	new $error_path;
			
			$error_path->$location();
			
			exit;
		}
	}
	
	/**
	 * Handles page requests.
	 * 
	 * @access	public
	 * @param	string	$path			File Path
	 * @param	string	$location		Subpath
	 * @return	void
	 */
	public function controller($path, $location)
	{
		// Handles bad requests
		if (!file_exists(SERVER_PATH . 'application/public/controllers/' . $path . '.php'))
		{
			$this->error();
		}
		else
		{
			// Getting the file.
			require_once(SERVER_PATH . 'application/public/controllers/' . $path . '.php');
			
			// Creates class.
			// Takes last part if there are slashes.
			$path	=	explode('/', $path);
			$path	=	end($path);
						
			$page	=	new $path;
			
			// Does the location exist?
			if (!is_callable(array($page, $location), false))
			{
				$this->error();
			}
			else
			{
				$page->$location();
				
				return;
			}
		}
	}
	
	/**
	 * Allows us to grab the page path.
	 * 
	 * @access	public
	 * @return	void
	 */
	private function get_path()
	{
		$path	=	(isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : @getenv('PATH_INFO');
		
		if (!trim($path, '/'))
		{
			//$path	=	(isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');
			
			if (!trim($path, '/'))
			{
				$path	=	str_replace($_SERVER['SCRIPT_NAME'], '', (isset($_SERVER['ORIG_PATH_INFO'])) ? $_SERVER['ORIG_PATH_INFO'] : @getenv('ORIG_PATH_INFO'));
				
				if (!trim($path, '/'))
				{
					$path	=	'';
					
					return $path;
				}
				else
				{
					return $path;
				}
			}
			else
			{
				return $path;
			}
		}
		else
		{
			return $path;
		}
	}
	
	/**
	 * Gets all our controllers and model information
	 * 
	 * @access	public
	 * @return	array
	 */
	public function get_locations()
	{
		$path	=	$this->get_path();
		
		if (!trim($path, '/'))
		{
			// Default
			$return['controller']	=	$this->settings->setting('default_path');
			$return['function']		=	$this->settings->setting('default_location');
			
			return $return;
		}
		else
		{
			// There appears to be something here...
			$path	=	trim($path, '/');
			
			$parts	=	explode('/', $path);
			
			// Remove item in the array
			if ($path[0] == '/')
			{
				array_shift($parts);
			}
			
			// We will call a controller file before a subfolder.
			// Lets see if it exists.
			$controller			=	$this->get_controller($parts);
			$controller_file	=	explode('/', $controller);
			$controller_file	=	end($controller_file);
			
			if ($controller === false)
			{
				$this->error();
			}
			else
			{
				$return['controller']	=	$controller;
				
				// Now we need to get the function.
				if (!isset($parts[$this->before_function + 1]) || !($parts[$this->before_function + 1]))
				{
					// Default
					$return['function']	=	$this->settings->setting('default_location');
				}
				else
				{
					require_once(SERVER_PATH . 'application/public/controllers/' . $controller . '.php');
					
					// It appears there is something there...
					// Lets see if the function exists
					$test_controller	=	new $controller_file;
					
					if (!is_callable(array($test_controller, $parts[$this->before_function + 1]), false))
					{
						$return['function']	=	$this->settings->setting('default_location');
						
						$return['vars_begin']	=	($this->before_function + 1);
					}
					else
					{
						$return['function']		=	$parts[$this->before_function + 1];
						
						$return['vars_begin']	=	($this->before_function + 2);
					}
				}
				
				$return['vars']			=	$parts;
				
				return $return;
			}
		}
	}
	
	/**
	 * Looking for the controller
	 * 
	 * @access	public
	 * @param	array	$parts
	 * @param	string	$folders
	 * @return	mixed
	 */
	private function get_controller($parts, $folders = '')
	{
		$path	=	SERVER_PATH . 'application/public/controllers/' . $folders;
		
		if (isset($parts))
		{
			if (file_exists($path . $parts[0] . '.php'))
			{
				// We have a controller
				return $folders . $parts[0];
			}
			else
			{
				// We don't have a controller yet
				// Lets see if a folder exists...
				if (file_exists($path . $parts[0]))
				{
					// A folder exists so we will dig deeper.
					$add_path				=	$parts[0];
					
					$shift_parts			=	array_shift($parts);
					
					$this->before_function	=	($this->before_function + 1);
					
					$controller				=	$this->get_controller($parts, $folders . $add_path . '/');
					
					return $controller;
				}
				else
				{
					// This doesn't exist... 404
					$this->error();
					return false;
				}
			}
		}
		else
		{
			return $folders . $this->settings->setting('default_path');
		}
	}
	
	/**
	 * Gets variables
	 * 
	 * @access	public
	 * @param	array	$vars
	 * @param	integer	$vars_begin
	 * @return	array
	 */
	public function get_vars($vars = '', $vars_begin = '')
	{
		// Settings
		$settings	=	new FLConfig('paths');
				
		// Style = index.php/folder/controller/model/value/value
		if ($settings->setting('path_style') == '0')
		{
			if (isset($vars[$vars_begin]))
			{
				$size	=	sizeof($vars);
				
				for ($i = $vars_begin; $i < $size; $i++)
				{
					$variables[]	=	$vars[$i];
				}
				
				return $variables;
			}
			else
			{
				return false;
			}
		}
		
		// Style = index.php/folder/controller/model/variable/value/another_variable/value/
		if ($settings->setting('path_style') == '1')
		{
			if (isset($vars[$vars_begin]))
			{
				$size	=	sizeof($vars);
				
				if ($this->is_even($vars_begin))
				{
					// Start on even or odd?
					$even	=	true;
				}
				else
				{
					$even	=	false;
				}
				
				for ($i = $vars_begin; $i < $size; $i++)
				{
					if ($even === true)
					{
						if ($this->is_even($i))
						{
							$variables[$vars[$i]]	=	$vars[$i + 1];
						}
						else
						{
							continue;
						}
					}
					else
					{
						if ($this->is_even($i))
						{
							continue;
						}
						else
						{
							$variables[$vars[$i]]	=	$vars[$i + 1];
						}
					}
				}
				
				return $variables;
			}
			else
			{
				return false;
			}
		}
		
		if ($settings->setting('path_style') == '2')
		{
			$variables	=	$_GET;
			
			return $variables;
		}
	}
	
	/**
	 * Is a number even?
	 * 
	 * @access	public
	 * @param	integer	$int
	 * @return	boolean
	 */
	private function is_even($int)
	{
		if (!is_int($int))
		{
		}
		else
		{
			if ($int&1)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}
}