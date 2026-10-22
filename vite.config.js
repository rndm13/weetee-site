import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    server: {
        host: true,
        port: 5173,
        strictPort: true,
        hmr: {
            host: '127.0.0.1'
        }
    },
    build: {
        chunkSizeWarningLimit: 3072, // 3MB
        assetsInlineLimit: 0,
    },
    plugins: [
        laravel({
            input: ["resources/css/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    base: "http://127.0.0.1:8000/"
});
