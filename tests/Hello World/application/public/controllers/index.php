<?php
class index
{
    private $template;

    public function __construct()
    {
        // Load Template Library
        load::library('FLTemplate');

        // Initialize template object
        $this->template = new FLTemplate;

        // Load Application Library HelloWorld
        load::app_library('HelloWorld');
    }

    public function main()
    {
        // Assign template variables
        $this->template->smarty->assign(array(
                'sayHello' => HelloWorld::sayHello()
            )
        );

        // Display our template page
        $this->template->smarty->display('helloworld.html');
    }
}