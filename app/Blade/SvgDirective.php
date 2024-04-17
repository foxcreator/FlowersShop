<?php

namespace App\Blade;

use Illuminate\Support\Facades\Blade;

class SvgDirective
{
    public static function register()
    {
        // Регистрация директивы @svg
        Blade::directive('svg', function ($expression) {
            // Разбор аргументов
            $params = self::parseExpression($expression);
            // Генерация SVG кода
            return "<svg class='{$params['class']}'>
                        <use xlink:href='{$params['sprite']}#{$params['name']}'></use>
                    </svg>";
        });
    }

    private static function parseExpression($expression)
    {
        // Разбор аргументов
        $args = explode(',', $expression);
        $name = trim($args[0], "'\"");
        $class = isset($args[1]) ? trim($args[1], " '\"") . ' icon' : 'icon-'. $name .' icon';
        $sprite = asset('front/svg/sprite.svg');
        return [
            'name' => $name,
            'class' => $class,
            'sprite' => $sprite,
        ];
    }
}
