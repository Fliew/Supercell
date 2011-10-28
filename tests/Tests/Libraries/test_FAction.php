<?php
class test_FAction
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
		load::library('FAction');
	}
	
	/**
	 * Runs our tests
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @return	void
	 */
	public function main()
	{
		$this->test_build_url();
		$this->test_redirect();
	}
	
	/**
	 * Test build_url()
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	private
	 * @return	void
	 */
	private function test_build_url()
	{
		$settings	=	new FConfig('paths');
		$case_val	=	FAction::build_url('test/test');
		
		if ($settings->setting('htaccess'))
		{
			assert('$case_val == \'/test/test\'');
		}
		else
		{
			assert('$case_val == \'index.php/test/test\'');
		}
	}
	
	/**
	 * Test redirect()
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	private
	 * @return	void
	 */
	private function test_redirect()
	{
		$case_val	=	FAction::redirect('http://fliew.com', 3);
		
		assert('$case_val == \'<meta http-equiv="refresh" content="3; url=http://fliew.com" />\'');
	}
}