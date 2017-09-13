const webpack = require('webpack');

/**
 * Parts from https://blog.flennik.com/the-fine-art-of-the-webpack-2-config-dc4d19d7f172
 * @param env
 * @returns {{entry: string, output: {filename: string, path}, module: {rules: [null]}, plugins: [null], devtool: string}}
 */
module.exports = (env = {}) => {
	const isProduction = env.production === true;
	return {
		entry: ['./assets/js/src/functions.js'],
		output: {
			filename: 'assets/js/bundle.js',
		},
		module: {
			rules: [
				/**
				 * Running Babel on JS files.
				 */
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: ['env']
						}
					}
				},
			]
		},
		plugins: [
			new webpack.BannerPlugin({
				banner: "Want to take a look at the JS before bundled by Webpack? Check out https://github.com/FlorianBrinkmann/nordby",
				entryOnly: true
			})
		],
		devtool: (() => {
			if (isProduction) return 'hidden-source-map'
			else return 'cheap-module-eval-source-map'
		})()
	}
};
