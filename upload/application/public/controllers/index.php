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
		try
		{
			load::library('FLTemplate');
		}
		catch (FLErrors $e)
		{
			echo $e->getMessage();
		}
		
		// Creates our template object
		$template	=	new FLTemplate;
		
		// Display a body
		$template->smarty->display('welcome.html');
	}
}