import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        colors: {
            main: "#d9f99d",
            black: "#0a0a0a",
            lightBlack: "#171717",
            dark:"#27272a",
            red: "#dc2626",
            redLight: "#f87171",
            redDark: "#991b1b",
            primary: "#eab308",
            button: "#4ade80",
            darkGreen: "#4d7c0f",
            buttonLight: "#ecfccb",
            buttonSecond: "#eab308",
            buttonSecondLight: "#ffedd5",
            gray: "#737373",
            lightGray: "#f3f4f6",
            white: "#ffffff",
        },
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
