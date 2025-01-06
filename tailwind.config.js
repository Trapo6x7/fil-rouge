/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  content: ["./**/*.php"],
  theme: {
    extend: {
      colors: {
        'primary-yellow' : '#ffe47b',
        'primary-purple' : '#9ba2ff',
        'secondary-gray' : '#333333',
        'off-white' : '#f9f6f1',
      },
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

