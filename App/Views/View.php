<?php

namespace App\Views;


class View {
    public static function view($template, $variables) {
        echo '<br>View -> view<br>';
        extract($variables);
        include ROOT . '/App/Views/' . $template . '.php';
    }
}