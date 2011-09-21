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
 * @category	FLCache
 */

class FLCache implements FLCacheInterface
{
	/**
	 * @access	private
	 * @var		string
	 */
	private $filename;
	
	/**
	 * @access	private
	 * @var		string
	 */
	private $path;
	
	/**
	 * @access	private
	 * @var		string
	 */
	private $file;
	
	/**
	 * @access	private
	 * @var		integer
	 */
	private $ttl;
	
	/**
	 * @access	private
	 * @var		boolean
	 */
	private $cache;
	
	/**
	 * @access	private
	 * @var		boolean
	 */
	private $started;
	
	/**
	 * Begin Cache
	 * 
	 * @access	public
	 * @param	string	$filename
	 * @param	integer	$ttl		Override Config TTL
	 * @return	void
	 */
	public function __construct($filename, $ttl = '')
	{
		// Init variables
		$this->filename	=	$filename;
		$this->path		=	SERVER_PATH . 'application/cache/general/';
		$this->file		=	$this->path . $this->filename;
		
		$config	=	new FLConfig('cache');
		
		$this->cache	=	$config->setting('general_caching');
		
		if ($this->cache)
		{
			$this->start	=	false;
			
			// Does the path exist
			if (!is_dir($this->path))
			{
				throw new FLErrors('Folder ' . $this->path . ' does not exist.')
			}
		
			$config	=	new FLConfig('cache');
		
			$this->cache	=	$config->setting('general_caching');
		
			if (!empty($ttl))
			{
				$this->ttl	=	$ttl;
			}
			else
			{
				$this->ttl	=	$config->setting('general_ttl');
			}
		}
	}
	
	/**
	 * Check if there is a valid cached file
	 * 
	 * @access	public
	 * @return	boolean
	 */
	public function is_cached()
	{
		if ($this->cache)
		{
			if (file_exists($this->file))
			{
				if ((filemtime($this->file) + $this->ttl) > time())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Start caching data
	 * 
	 * @access	public
	 * @return	void
	 */
	public function start()
	{
		if ($this->cache)
		{
			$this->start	=	true;
			
			ob_start();
		}
	}
	
	/**
	 * Stop caching data
	 * 
	 * @access	public
	 * @return	void
	 */
	public function end()
	{
		if ($this->cache)
		{
			if ($this->start)
			{
				$fp		=	fopen($this->file, 'w');
				
				fwrite($fp, ob_get_contents());
				
				fclose($fp);
				
				ob_end_flush();
			}
			else
			{
				throw new FLErrors('Could not end a cache session that hasn\'t been started.')
			}
		}
	}
	
	/**
	 * Display cached file
	 * 
	 * @access	public
	 * @return	string
	 */
	public function display()
	{
		include($this->file);
	}
	
	/**
	 * Clear cached file if exists
	 * 
	 * @access	public
	 * @return	boolean
	 */
	public function clear()
	{
		if ($this->cache)
		{
			$file	=	$this->path . $this->filename;
		
			if (file_exists($file))
			{
				return unlink($file);
			}
			else
			{
				return false;
			}
		}
	}
}