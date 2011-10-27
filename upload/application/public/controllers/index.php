<?php
// Example File
class index
{
	/**
	 * Example main function
	 * 
	 * @access	public
	 * @return	void
	 */
	public function main()
	{
		// Load Template Library
		load::library('FTemplate');
		
		// Creates our template object
		$template	=	new FTemplate;
		
		// Display a body
		$template->smarty->display('welcome.html');
	}
}