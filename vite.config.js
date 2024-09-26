import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
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
});
