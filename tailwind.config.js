import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Manrope reemplaza a la fuente por defecto de todo el sitio
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                // Registramos Ragick por si queremos usar la clase font-ragick manualmente
                ragick: ['"Ragick"', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
