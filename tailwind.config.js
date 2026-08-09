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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    teal: '#115468',
                    forest: '#0c6649',
                    emerald: '#148d3a',
                    'emerald-hover': '#10722f',
                    bg: '#F8FAFC',
                    primary: '#148d3a',
                    'primary-hover': '#10722f',
                    secondary: '#148d3a',
                    'secondary-hover': '#10722f',
                    light: '#f1f6f8',
                },
            },
        },
    },

    plugins: [forms],
};
