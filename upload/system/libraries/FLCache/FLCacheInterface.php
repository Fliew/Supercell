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

interface FLCacheInterface
{
	/**
	 * Begin Cache
	 * 
	 * @access	public
	 * @param	string	$filename
	 * @param	integer	$ttl		Override Config TTL
	 * @return	void
	 */
	public function __construct($filename, $ttl = '');
	
	/**
	 * Check if there is a valid cached file
	 * 
	 * @access	public
	 * @return	boolean
	 */
	public function is_cached();
	
	/**
	 * Start caching data
	 * 
	 * @access	public
	 * @return	void
	 */
	public function start();
	
	/**
	 * Stop caching data
	 * 
	 * @access	public
	 * @return	void
	 */
	public function end();
	
	/**
	 * Display cached file
	 * 
	 * @access	public
	 * @return	void
	 */
	public function display();
	
	/**
	 * Clear cached file if exists
	 * 
	 * @access	public
	 * @return	boolean
	 */
	public function clear();
}