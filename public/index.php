<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php
        require_once '../vendor/autoload.php';

        use Twig\Loader\FilesystemLoader;
        use Twig\Environment;

        // Загрузка шаблонов
        $loader = new FilesystemLoader('../views');
        $twig = new Environment($loader);

        // URL запроса
        $url = $_SERVER["REQUEST_URI"];

        // Меню
        $nav = [
            ["title" => "Главная", "url" => "/"],
            ["title" => "Джедаи", "url" => "/jedi"],
            ["title" => "Ситхи", "url" => "/sith"]
        ];

        // Значения по умолчанию
        $template = "";
        $context = [
            "nav" => $nav,
            "current_url" => $url
        ];

        // Разрешённые персонажи по группам
        $allowedJedi = ['obi-wan', 'ahsoka', 'kel-kestis', 'anakin'];
        $allowedSith = ['vader', 'maul', 'dooku', 'starkiller'];

        // Определение шаблона
        if ($url == "/") {
            $template = "main.twig";
            $context["title"] = "Star Wars";
        } elseif (preg_match("#^/jedi#", $url)) {
            $template = "jedi.twig";
            $context["title"] = "Jedi";
        } elseif (preg_match("#^/sith#", $url)) {
            $template = "sith.twig";
            $context["title"] = "Sith";
        } elseif (preg_match("#^/characters/([a-zA-Z0-9\-]+)$#", $url, $matches)) {
            // Получаем slug героя
            $slug = $matches[1];

            if (in_array($slug, $allowedJedi)) {
                $template = "characters/" . $slug . ".twig";
                $context["title"] = ucfirst(str_replace('-', ' ', $slug));
            } elseif (in_array($slug, $allowedSith)) {
                $template = "characters/" . $slug . ".twig";
                $context["title"] = ucfirst(str_replace('-', ' ', $slug));
            } else {
                $template = "404.twig";
                $context["title"] = "404 - Страница не найдена";
            }
        } else {
            $template = "404.twig";
            $context["title"] = "404 - Страница не найдена";
        }

        // Рендер
        echo $twig->render($template, $context);
        ?>
    </div>
</body>
</html>
