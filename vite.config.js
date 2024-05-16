import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import svgSpritePlugin from 'vite-plugin-svg-sprite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/order.js',
                'resources/js/catalog.js',
            ],
            refresh: true,
        }),
        svgSpritePlugin({
            symbolId: 'icon-[name]', // Префикс для id каждого символа
            include: 'resources/svg/*.svg', // Путь к SVG файлам
            svgoConfig: {}, // Опционально: настройки оптимизации SVG
        }),
    ],
});
