<?php
// Example File
class index
{
	/**
	 * Example main function
	 * 
	 * @author	Riley Wiebe
	 * 
	 * @access	public
	 * @return	void
	 */
	public function main()
	{
		// Load Template Library
		load::library('FTemplate');
		
		// Creates our template object
		$init_template	=	new FTemplate;
		
		// Creates variable for smarty
		$template	=	$init_template->template();
		
		// Display a body
		$template->display('welcome.html');
		
		// Single line
		//$init_template->template()->display('welcome.html');
	}
}