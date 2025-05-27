<?php
// controllers/CharacterController.php
require_once 'BaseController.php';
require_once 'ErrorController.php';

class CharacterController extends BaseController {
    private $allowedJedi = ['obi-wan', 'ahsoka', 'kel-kestis', 'anakin'];
    private $allowedSith = ['vader', 'maul', 'dooku', 'starkiller'];

    public function show($slug) {
        if (in_array($slug, $this->allowedJedi) || in_array($slug, $this->allowedSith)) {
            $this->render("characters/{$slug}.twig", ['title' => ucfirst(str_replace('-', ' ', $slug))]);
        } else {
            $errorController = new ErrorController();
            $errorController->notFound();
        }
    }
}