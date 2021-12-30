<?php

class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'File not found';
                
        if(file_exists($templatePath)){

            extract($variables); // translates dictionary to variables (keys becomes names of the variables)
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}