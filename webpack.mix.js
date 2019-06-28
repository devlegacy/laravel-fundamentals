const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
const webpack = require('webpack');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

mix
  .webpackConfig({
    output: {
      filename: `[name]${mix.inProduction() ? '.[hash]' : ''}.js`,
      chunkFilename: `[name]${mix.inProduction() ? '.[chunkhash]' : ''}.js`,
    },
    optimization: {
      splitChunks: {
        cacheGroups: {
          vendors: false, // Disable vendor
        },
      },
      minimizer: mix.inProduction() ? [
        new TerserPlugin(
          {
            parallel: true,
          }
        ),
        new OptimizeCssAssetsPlugin({
          cssProcessorPluginOptions: {
            preset: ['default', { discardComments: { removeAll: true } }],
          },
        }),
      ] : [],
    },
    plugins: [
      new webpack.HashedModuleIdsPlugin(), // so that file hashes don't change unexpectedly
      new webpack.ProgressPlugin(),
      new webpack.NamedModulesPlugin(),

    ],
  })
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');
