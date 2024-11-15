/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                bg_black: "rgb(var(--bg-black))",
                bg_gray: "rgb(var(--bg-gray))",
                primary: "rgb(var(--primary))",
                secondary: "rgb(var(--secondary))",
                text_gray: "rgb(var(--text-gray))",
                detail: "rgb(var(--detail))",
                error: "rgb(var(--error))",
                gold: "rgb(var(--gold))",
            },
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                roboto: ["Roboto", "sans-serif"],
            },
        },
    },
    plugins: [],
};
