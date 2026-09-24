import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
   server: {
        // penambahan manual supaya bisa reload otomastis di device lain
        host: '192.168.100.108',
        // host: '10.222.142.210',

        // host: '0.0.0.0',
        hmr: {
            host: '192.168.100.108',
            //    host: '10.222.142.210',
        },
        // ////////////////////////
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
