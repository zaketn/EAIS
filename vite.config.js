import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue"

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                // 'resources/css/Plugins/bootstrap.min.css',
                // 'resources/js/Plugins/bootstrap.bundle.min.js',
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    }
});
