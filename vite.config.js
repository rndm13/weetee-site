import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    server: { host: true },
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
