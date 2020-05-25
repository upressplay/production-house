module.exports = {
  mode: 'development',
  output: {
    filename: 'main.min.js'
  },
  plugins: [],
  module: {
    rules: [
      {
        test: /\.js$/, // using regex to tell babel exactly what files to transcompile
        exclude: /node_modules/, // files to be ignored
        use: {
          loader: 'babel-loader' // specify the loader to be used
        }
      }
    ]
  }
};