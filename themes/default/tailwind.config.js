module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./themes/default/**/*.{blade.php,js,vue,ts}",
    ],

    theme: {
        extend: {
        },
    },

    plugins: [require("daisyui")],

};
