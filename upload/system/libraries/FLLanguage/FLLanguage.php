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
 * @category	FLLanguage
 */

class FLLanguage implements FLLanguageInterface
{
	/**
	 * @access	private
	 * @var		array
	 */
	private static $lang_array	=	array();
	
	/**
	 * Display content
	 * 
	 * @access	public
	 * @static
	 * @param	string	$variable
	 * @return	string
	 */
	public static function display($name, $custom_lang = '')
	{
		// Load Configs
		$language_config	=	new FLConfig('language');
		$cache_config		=	new FLConfig('cache');
		
		$language_path	=	SERVER_PATH . 'application/public/languages/'. $language_config->setting('default_language');
		$cache_path		=	CACHE_PATH . 'language/' . $language_config->setting('default_language') . '.php';
		
		// Are we caching?
		if ($cache_config->setting('language_cache') === true)
		{
			// Lets check if we have a cached file and it is under the ttl
			if (!file_exists($cache_path))
			{
				// We need to cache
				$cache	=	self::cache($cache_path, $language_config->setting('default_language'), $cache_config->setting('language_ttl'));
				
				return $cache[$name];
			}
			else
			{
				// The file exists, now we will check ttl
				require_once($cache_path);
				
				if (!isset($ttl) || $ttl < time())
				{
					// We need to cache this again.
					$cache	=	self::cache($cache_path, $language_config->setting('default_language'), $cache_config->setting('language_ttl'));
					
					return $cache[$name];
				}
				else
				{
					// Everything appears to be good, lets give them the data
					return $language_compiled[$name];
				}
			}
		}
		else
		{
			// We need to compile it everytime.
			$process	=	self::process($language_config->setting('default_language'));
			
			return $process[$name];
		}
	}
	
	/**
	 * Cache
	 * 
	 * @access	public
	 * @param	string	$path
	 * @param	string	$language
	 * @param	integer	$ttl
	 * @return	void
	 */
	private static function cache($path, $language, $ttl)
	{
		$compiled	=	self::process($language);
		
		$content	=	"<?php\n" . '$ttl=' . (time() + $ttl) . ";\n" . '$language_compiled=array(';
		
		$num	=	sizeof($compiled);
		
		foreach ($compiled as $variable => $value)
		{
			$content	.=	'\'' . $variable . '\'' .  '=>' . '\'' . $value . "',";
		}
		
		$content	=	substr($content, 0, -1);
		
		$content	.=	');';
		
		if (!$handle = fopen($path, 'w'))
		{
			throw new FLErrors('Could not open file');
		}
		
		if (fwrite($handle, $content) === false)
		{
			throw new FLErrors('Could not write to file');
		}
		
		fclose($handle);
		
		return $compiled;
	}
	
	/**
	 * Cache
	 * 
	 * @access	public
	 * @param	string	$language
	 * @return	array
	 */
	private static function process($language)
	{
		// Compile
		$array	=	array();
		
		if ($files = opendir(SERVER_PATH . 'application/public/languages/' . $language . '/'))
		{
			while (false !== ($file = readdir($files)))
			{
				// We now know the file names.
				// What do we want to ignore?
				if (preg_match('/^[\.]/si', $file) || preg_match('/^index\.html$/si', $file))
				{
				}
				else
				{
					// Adds to array.
					$name				=	explode('.', $file);
					$array[$name[0]]	=	$file;
				}
			}
			
			// We now have the file names so we can find out whats the what.
			if (!$array)
			{
				return false;
			}
			else
			{
				$key	=	array_keys($array);
				$size	=	sizeof($key);
				
				for ($i = 0; $i < $size; $i++)
				{
					require(SERVER_PATH . 'application/public/languages/' . $language . '/' . $array[$key[$i]]);
					
					if (!is_array($$key[$i]))
					{
						throw new FLErrors('The language file\'s (' . $array[$key[$i]] . ') variable (' . $key[$i] . ') does not have an array.');
					}
					
					self::$lang_array	=	array_merge(self::$lang_array, $$key[$i]);
				}
			}
			
			return self::$lang_array;
		}
	}
}