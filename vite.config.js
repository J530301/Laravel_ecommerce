import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css'],
      refresh: true, // Ensures hot reload for Blade, CSS, and JS
    }),
    tailwindcss(),
  ],
  server: {
    watch: {
      usePolling: false, // Faster file watching
    },
    hmr: {
      host: 'localhost', // Ensures HMR works properly
    },
  },
});
