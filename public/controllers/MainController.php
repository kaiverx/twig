<?php
require_once 'BaseController.php';

class MainController extends BaseController {
    public function index() {
        $this->render('main.twig', ['title' => 'Star Wars']);
    }
}
