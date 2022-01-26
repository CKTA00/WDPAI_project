<?php

class AppController {
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $request;
    protected $userLogin;
    protected $message;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->userLogin = $_COOKIE['userLogin'];
        $this->message = [];
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

    protected function validateFile(array $file): bool
    {
        if ($file["size"] > self::MAX_FILE_SIZE) {
            $this->message[] = "Image file is too large.";
            return false;
        }

        if (!isset($file["type"]) || !in_array($file["type"], self::SUPPORTED_TYPES)) {
            $this->message[] = 'This file format is not supported.';
            return false;
        }
        return true;
    }
}