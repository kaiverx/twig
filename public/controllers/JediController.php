<?php
// controllers/JediController.php
require_once __DIR__ . '/BaseController.php';

class JediController extends BaseController {
    public function index() {
        $this->render('jedi.twig', ['title' => 'Jedi']);
    }
}
