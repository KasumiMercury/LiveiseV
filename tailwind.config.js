const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: ["./resources/views/**/*.blade.php", "./resources/js/**/*.vue"],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                Caveat: ["Caveat", "cursive"],
                Raleway: ["Raleway", "sans-serif"],
                ZenMaru: ['"Zen Maru Gothic"', "sans-serif"],
                body: ["Raleway", '"Zen Maru Gothic"', "sans-serif"],
            },
            fontSize: {
                xxs: ".6rem",
                xs: ".75rem",
            },
            keyframes: {
                appear: {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
                disappear: {
                    "0%": { opacity: 1 },
                    "100%": { opacity: 0 },
                },
                flicker: {
                    "0%": { opacity: 0.99 },
                    "19.999%": { opacity: 0.99 },
                    "20%": {
                        opacity: 0.4,
                    },
                    "21.999%": {
                        opacity: 0.4,
                    },
                    "22%": { opacity: 0.99 },
                    "62.999%": { opacity: 0.99 },
                    "63%": {
                        opacity: 0.4,
                    },
                    "63.999%": {
                        opacity: 0.4,
                    },
                    "64%": { opacity: 0.99 },
                    "64.999%": { opacity: 0.99 },
                    "65%": {
                        opacity: 0.4,
                    },
                    "69.999%": {
                        opacity: 0.4,
                    },
                    "70%": { opacity: 0.99 },
                    "100%": { opacity: 0.99 },
                },
            },
            animation: {
                appear: "appear 1.5s ease 2s 1 forwards",
                disappear: "disappear 3s ease 0s 1 forwards",
                flicker: "flicker 3s linear infinite",
            },
        },
    },
    plugins: [
        function ({ addUtilities }) {
            const newUtilities = {
                ".text-shadow": {
                    textShadow: "0px 2px 3px",
                },
                ".text-shadow-md": {
                    textShadow: "0px 3px 3px",
                },
                ".text-shadow-lg": {
                    textShadow: "0px 5px 3px",
                },
                ".text-shadow-xl": {
                    textShadow: "0px 7px 3px",
                },
                ".text-shadow-2xl": {
                    textShadow: "0px 10px 3px",
                },
                ".text-shadow-none": {
                    textShadow: "none",
                },
                ".text-emit": {
                    textShadow: "0px 0px 3px",
                },
                ".text-emit-md": {
                    textShadow: "0px 0px 5px",
                },
                ".text-emit-lg": {
                    textShadow: "0px 0px 10px",
                },
                ".text-emit-xl": {
                    textShadow: "0px 0px 15px",
                },
                ".text-emit-2xl": {
                    textShadow: "0px 0px 20px",
                },
                ".box-emit": {
                    boxShadow: "0px 0px 10px",
                },
            };

            addUtilities(newUtilities);
        },
    ],
};
