<?php
class test_FCache
{
	/**
	 * Load required files
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		// Load FAction library
		load::library('FCache');
	}
	
	/**
	 * Runs all of the tests
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @return	void
	 */
	public function main()
	{
		$cache	=	new FCache('testCase', 3600);
		
		if (!file_exists(CACHE_PATH . 'general/testCase'))
		{
			// Check if we have anything cached, should be false.
			assert('$cache->is_cached() === false');
		}
		
		$cache->start();
		echo "This text is just to test the creation of the cache file. It is not an error.";
		$cache->end();
		
		assert('$cache->is_cached()');
		
		echo "\n<br />The text above and below should be the same.<br />\n";
		
		assert('$cache->display()');
		
		$cache->clear();
		
		assert('$cache->display() === false');
		
		assert('$cache->is_cached() === false');
	}
}