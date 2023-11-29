<?php 

class View
{	
    protected $template = 'template.php';

    public function render($contentPath, $data = [])
    {
        if (is_array($data)) {
            extract($data);
        }
        
        $path = __DIR__ . '/../App/Views/' . $this->template;
        $content = '';

        if (file_exists($contentPath)) {
            ob_start();
            require_once $contentPath;
            $content = ob_get_clean();
        }

        if (file_exists($path)) {
            ob_start();
            require_once $path;
            $templateContent = ob_get_clean();

            echo str_replace('<?= $content ?>', $content, $templateContent);
        }
    }
}