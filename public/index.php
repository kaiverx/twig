<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"  rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php
        // Подключаем автозагрузку Composer
        require_once '../vendor/autoload.php';

        // Устанавливаем директорию с шаблонами
        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $twig = new \Twig\Environment($loader);

        // Получаем текущий URL
        $url = $_SERVER["REQUEST_URI"];

        // Значения по умолчанию
        $template = "";
        $context = [];

        // Определяем, какой шаблон использовать и контекст для него
        if ($url == "/") {
            $template = "main.twig";
            $context = [
                "title" => "Star Wars"
            ];
        } elseif (preg_match("#/jedi#", $url)) {
            $template = "jedi.twig";
            $context = [
                "title" => "Jedi"
            ];
        } elseif (preg_match("#/sith#", $url)) {
            $template = "sith.twig";
            $context = [
                "title" => "Sith"
            ];
        } else {
            // шаблон 404 если ничего не подошло
            $template = "404.twig";
            $context = [
                "title" => "404 - Страница не найдена"
            ];
        }

        // Рендерим шаблон
        echo $twig->render($template, $context);
        ?>
    </div> 
</body>
</html>
