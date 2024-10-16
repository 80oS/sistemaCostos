import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';
const host = process.env.TAURI_DEV_HOST;

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
        strictPort: true,
        host: host || false,
        port: 5173,
    },

    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
        }
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
        target: process.env.TAURI_PLATFORM == 'windows' ? 'chrome105' : 'safari13', // Optimización según el SO
        minify: !process.env.TAURI_DEBUG ? 'esbuild' : false,
        sourcemap: !!process.env.TAURI_ENV_DEBUG,
    },
    clearScreen: false,
    envPrefix: ['VITE_', 'TAURI_'],
});
