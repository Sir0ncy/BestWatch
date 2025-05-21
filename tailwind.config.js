// /** @type {import('tailwindcss').Config} */
// export default {
//   content: [
//     './resources/**/*.blade.php',
//     './resources/**/*.js',
//     './resources/**/*.vue',
//   ],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }

/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    screens:{
      'xs': '350px',
      ...defaultTheme.screens,
    },
    extend: {
      fontFamily: {
        'montserrat': ['Montserrat','sans-serif'],
        'poppins': ['Poppins','sans-serif'],
      },
      fontSize: {
        'xxs': '.65rem'
      },
    },
  },
  plugins: [],
}

