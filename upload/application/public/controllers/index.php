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
		FLLog::clear_log();
		// Load Template Library
		load::library('FLTemplate');
		
		// Creates our template object
		$template	=	new FLTemplate;
		
		// Display a body
		$template->smarty->display('welcome.html');
	}
}