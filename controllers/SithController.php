<?php
// controllers/SithController.php
require_once 'BaseController.php';

class SithController extends BaseController {
    public function index() {
        $this->render('sith.twig', ['title' => 'Sith']);
    }
}