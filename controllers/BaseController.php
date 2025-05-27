<?php
// controllers/BaseController.php
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class BaseController {
    protected $twig;
    protected $nav;

    public function __construct() {
        $loader = new FilesystemLoader('../views');
        $this->twig = new Environment($loader);

        $this->nav = [
            ["title" => "Главная", "url" => "/"],
            ["title" => "Джедаи", "url" => "/jedi"],
            ["title" => "Ситхи", "url" => "/sith"]
        ];
    }

    protected function render($template, $context = []) {
        $context['nav'] = $this->nav;
        $context['current_url'] = $_SERVER['REQUEST_URI'];
        echo $this->twig->render($template, $context);
    }
}