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
                glass: {
                    light: 'rgba(255, 255, 255, 0.1)',
                    lighter: 'rgba(255, 255, 255, 0.15)',
                    medium: 'rgba(255, 255, 255, 0.2)',
                },
                'green-glow': '#10b981',
                'blue-glow': '#0ea5e9',
            },
            backdropBlur: {
                glass: '10px',
                'glass-lg': '20px',
            },
            boxShadow: {
                glass: '0 8px 32px 0 rgba(31, 38, 135, 0.37)',
                'glass-lg': '0 8px 32px 0 rgba(31, 38, 135, 0.5)',
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            },
        },
    },

    plugins: [forms],
};
