import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Figtree
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f1f5fd',
                    100: '#dfe9fa',
                    200: '#c6d9f7',
                    300: '#9fc1f1',
                    400: '#729fe8',
                    500: '#4978df',
                    600: '#3c62d4',
                    700: '#334fc2',
                    800: '#2f429e',
                    900: '#2b3b7d',
                },
                success: {
                    50: '#EEFCF3',
                    200: '#B5F5CC',
                    400: '#4BD87D',
                    600: '#239849',
                    800: '#1B5A31',
                },
            }
        },
    },

    plugins: [forms],
};
