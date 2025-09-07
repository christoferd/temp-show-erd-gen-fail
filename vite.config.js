import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // Chris D. 6-Sep-2025 - my custom theme file
                'resources/css/filament/theme.css',
                'resources/js/app.js'
            ],
            // Full reload when these files change:
            refresh: [
                'resources/views/**/*.blade.php',
                'routes/**/*.php',
                'app/**/*.php',
                'config/**/*.php',
                'resources/lang/**/*.php',
                // Custom Theme file: https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme
                'resources/css/filament/admin/theme.css',
            ],
        }),
        tailwindcss(),
    ],
});
