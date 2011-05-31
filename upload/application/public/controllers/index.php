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
		// Load Libraries
		load::library('FLTemplate');
		
		// Creates our template object
		$template	=	new FLTemplate;
		
		// Display a body
		$template->smarty->display('welcome.html');
	}
}