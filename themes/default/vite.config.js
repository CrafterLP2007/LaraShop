import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "themes/default/css/app.css",
                "themes/default/js/app.jsx"
            ],
            buildDirectory: "default",
        }),

        react(),
        {
            name: "blade",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".blade.php")) {
                    server.ws.send({
                        type: "full-reload",
                        path: "*",
                    });
                }
            },
        },
    ],
    resolve: {
        alias: {
            '@': '/themes/default/js',

        }
    },
});
