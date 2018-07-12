// module.exports = {
module.exports = (ctx) => ({
	map: ctx.env === 'development' ? ctx.map : false,
	plugins: {
    'postcss-import': {},
    'postcss-cssnext': {},
		'cssnano': ctx.env === 'production' ? {} : false
  }
});