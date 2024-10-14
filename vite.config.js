import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({

	server: {
		host: '0.0.0.0',
		port: 5174,
	},
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css', 
            ],
            refresh: true,
        }),
    ],
});
