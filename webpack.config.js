const path = require('path');

module.exports = {
    entry: './assets/src/js/app.js',
    output: {
        filename: 'app.min.js',
        path: path.resolve(__dirname, 'assets/js')
    },
    optimization: {
        mangleExports: true,
    }
};