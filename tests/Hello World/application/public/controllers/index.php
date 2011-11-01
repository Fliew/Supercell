<?php
class index
{
    private $template;

    public function __construct()
    {
        // Load Template Library
        load::library('FTemplate');

        // Initialize template object
        $template = new FTemplate;
		$this->template = $template->template();

        // Load Application Library HelloWorld
        load::app_library('HelloWorld');
    }

    public function main()
    {
        // Assign template variables
        $this->template->assign(array(
                'sayHello' => HelloWorld::sayHello()
            )
        );

        // Display our template page
        $this->template->display('helloworld.html');
    }
}