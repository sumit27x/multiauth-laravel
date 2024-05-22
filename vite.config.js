import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),
    ],
});



// import { defineConfig } from 'vite';
// import react from '@vitejs/plugin-react';
// import { resolve } from 'path';

// export default defineConfig({
//   plugins: [react()],
//   build: {
//     outDir: resolve(__dirname, 'public/build'),
//     rollupOptions: {
//       input: {
//         main: resolve(__dirname, 'resources/js/app.jsx'),
//       }
//     }
//   }
// });
