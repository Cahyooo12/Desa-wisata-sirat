import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#4a0080",
                "secondary": "#2e7d32",
                "background-light": "#f7f5f8",
                "background-dark": "#1b0f23",
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                "display": ["Plus Jakarta Sans", "sans-serif"]
            },
            borderRadius: {
                "lg": "1.5rem",
                "xl": "2rem",
                "2xl": "3rem",
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
    ],
};
