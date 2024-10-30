import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                
            ],
            refresh: true,
            buildDirectory: 'build'
        }),
    ],

    server: {
        port: 3000, // Cambia a otro puerto si es necesario
    },
    
    build: {
        outDir: 'public/build',
        manifest: 'manifest.json',
        assetsDir: 'assets',
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name].[hash].[ext]',
                chunkFileNames: 'assets/[name].[hash].js',
                entryFileNames: 'assets/[name].[hash].js',
            },
        },
        emptyOutDir: true,
    }
});
