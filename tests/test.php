<?php
// Functionality test file
// This file must be uploaded into the controllers folder
class test
{
	/**
	 * Init
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		// Load Libraries
		load::library('FLAction');
		load::library('FLDatabase');
		load::library('FLDate');
		load::library('FLXml');
	}
	
	/**
	 * Example main function
	 * 
	 * @access	public
	 * @return	void
	 */
	public function main()
	{
		// FLAction Test
		echo '<b>FLAction</b><br />';
		$url_variables	=	FLAction::get_vars();
		
		echo 'get_vars: ';
		var_dump($url_variables);
		
		echo '<br />';
		
		$build_url	=	FLAction::build_url('test/test');
		
		echo 'build_url: ';
		var_dump($build_url);
		
		echo '<br /><br />';
		
		// FLDatabase Test
		
		echo '<br /><br />';
		// FLDate Test
		echo '<b>FLDate</b><br />';
		echo 'europe: ' . FLDate::europe(time()) . '<br />';
		echo 'europe_num: ' . FLDate::europe_num(time()) . '<br />';
		echo 'american: ' . FLDate::american(time()) . '<br />';
		echo 'american_num: ' . FLDate::american_num(time()) . '<br />';
		
		echo '<br /><br />';
		
		// FLFilter
		
		// FLXml
		$xml	=	FLXml::build('title', 'description', '', '', array(
				'name'	=>	'value'
			)
		);
		
		var_dump($xml);
	}
	
	/**
	 * Subpage test
	 * index.php/test/subpage
	 * 
	 * @access	public
	 * @return	void
	 */
	public function subpage()
	{
		echo 'Hello world';
	}
}