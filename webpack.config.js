const path              = require('path');
const webpack           = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const extractPlugin     = new ExtractTextPlugin({
  filename: '../[name].css'
});

const wpContentDirName  = 'app/www/wp-content';
const themeName         = 'beeldblinkers';
const localDomain       = 'localhost';

module.exports = {
  entry: {
		style: "./" + wpContentDirName + "/themes/" + themeName + "/js/app.js",
		// backEnd: "./" + wpContentDirName + "/themes/" + themeName + "/js/admin.js",
	},
  output: {
      path: __dirname + "/" + wpContentDirName + "/themes/" + themeName + "/js",
      filename: '[name].bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: [
          {
            loader: 'babel-loader?cacheDirectory=true',
            options: {
              presets: ['env']
            }
          }
        ]
      },
      {
        test: /\.scss$/,
        use: extractPlugin.extract({
            // compile scss to css with sass-loader -> then postcss-loader does autoprefixing (see postcss.config.js)
            use: ['css-loader', 'postcss-loader', 'sass-loader'],
        })
      },
    ]
  },
  plugins: [
    // new webpack.ProvidePlugin({
    //   Flickity: 'flickity',
    // }),
    new BrowserSyncPlugin({
      // browse to http://localhost:3000/ during development, 
      port: 3000,
      files: [
        './' + wpContentDirName + '/themes/' + themeName + '/*.php', 
        './' + wpContentDirName + '/plugins/*.php', 
        './' + wpContentDirName + '/uploads/*.jpg',
        './' + wpContentDirName + '/uploads/*.png',
        './' + wpContentDirName + '/uploads/*.svg'
      ],
      proxy: localDomain
    }),
    extractPlugin,
  ]
}