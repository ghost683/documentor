<?php
namespace App;


use App\Config\Settings;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;



class TwigEngine
{
    
    private $twig;
    
    
    
    public function __construct() {
        $loader = new FilesystemLoader(Settings::get("TEMPLATE_DIR"));
        $this->twig = new Environment($loader);
    }
    
    public function render( $template,  $data = [])  {
        return $this->twig->render($template, $data);
    }
    
    
}

