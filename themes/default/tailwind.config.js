import path from 'path';
import autoprefixer from 'autoprefixer';

module.exports = {
    content: [
        path.resolve(__dirname, "./**/*.{blade.php,js,vue,ts}"),
    ],

    theme: {
        extend: {},
    },

    plugins: [
        autoprefixer,
    ],
};
