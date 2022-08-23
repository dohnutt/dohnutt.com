const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: './_src/js/app.js',
    output: {
        filename: 'app.min.js',
        path: path.resolve(__dirname, 'js')
    },
    optimization: {
        mangleExports: true,
    },
    target: 'browserslist',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader'],
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: { url: false }
                    },
                    'postcss-loader',
                    'sass-loader'
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({ filename: '../style.css' })
    ],
    externals: {
        // jQuery is external and available via the global var `jQuery`
        "jquery": "jQuery"
    },
    performance: {
        hints: false,
        maxEntrypointSize: 512000,
        maxAssetSize: 512000
    }
};