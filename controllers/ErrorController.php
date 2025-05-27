<?php
// controllers/ErrorController.php
require_once 'BaseController.php';

class ErrorController extends BaseController {
    public function notFound() {
        http_response_code(404);
        $this->render('404.twig', ['title' => '404 - Страница не найдена']);
    }
}