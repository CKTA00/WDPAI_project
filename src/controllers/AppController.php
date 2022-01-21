<?php

class AppController {
    private $request;
    protected $userLogin;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->userLogin = $_COOKIE['userLogin'];
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function render(string $template = null, array $variables = []): void
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