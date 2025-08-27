import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],

    //to host in server that's not just localhost
    server: {
        host: true,
        //wifi ccit
        // host: '192.168.68.121'

        //hotspot hp
        // host: '10.214.155.1' 

        host: '10.0.12.56'
    }
});
