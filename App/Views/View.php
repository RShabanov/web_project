<?php

namespace App\Views;


class View {
    public static function view($template, $variables) {
        extract($variables);
        include ROOT . '/App/Views/' . $template . '.php';
    }
}