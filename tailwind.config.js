module.exports = {
  mode: 'jit',
  purge: [
      './storage/framework/views/*.php',
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        fontFamily: {
            'primary': ['Poppins', 'Roboto'],
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
