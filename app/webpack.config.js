const path = require('path');
const webpack = require('webpack');
const CompressionPlugin = require('compression-webpack-plugin');

const optionDefinitions = [
    { name: 'verbose', alias: 'v', type: Boolean },
    { name: 'src', type: String, multiple: true, defaultOption: true },
    { name: 'timeout', alias: 't', type: Number },
    { name: 'mode', type: String, defaultOption: 'unknown' },
    { name: 'analyze', type: Boolean, defaultOption: false },
    { name: 'watch', type: Boolean},
];


const commandLineArgs = require('command-line-args');
const options = commandLineArgs(
  optionDefinitions,
  {partial: false}
);

// const TimestampWebpackPlugin = require('timestamp-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

module.exports = {
    devtool: 'source-map',
    entry: {
        app: [
            './public/tsx/bootstrap.tsx',
        ]
    },
    module: {
        rules: [
            {
                test: /\.(ts|tsx)$/,
                loader: 'ts-loader'
            },
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
            {
                enforce: "pre",
                test: /\.js$/,
                loader: "source-map-loader"
            }
        ]
    },
    optimization: {
        splitChunks: {
            cacheGroups: {
                default: false,
                vendors: false,
            }
        }
    },
    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: '[name].bundle.js'
    },
    performance: {
        hints: false,
    },
    plugins: [
        // new BundleAnalyzerPlugin({
        //     analyzerHost: "0.0.0.0",
        //     analyzerMode: options.analyze === "enabled" ? 'static': "server",
        //     openAnalyzer: false
        // })
        new CompressionPlugin(),
        new webpack.EnvironmentPlugin({
            PHP_WEB_BUGS_BASE_URL: undefined,
        }),
        new webpack.optimize.LimitChunkCountPlugin({
            maxChunks: 1,
        }),
    ],
    resolve: {
        extensions: ['.js', '.jsx', '.json', '.ts', '.tsx'],
        "alias": {
            "react": "preact/compat",
            "react-dom/test-utils": "preact/test-utils",
            "react-dom": "preact/compat"
        }
    },
};