<?php

class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.html';
        $output = 'File not found';
                
        if(file_exists($templatePath)){

            //$varaibles['recipes'] = ["pizza","burgir"];
            extract($variables); //zamienia klucze na zmienne
            //echo $recipes
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}