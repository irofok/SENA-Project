/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily:{
        titulos: "'Archivo Black', sans-serif;",
        chivo: "'Chivo', sans-serif;",
        lexend: "'Lexend', sans-serif;",
        poppins: "'Poppins', sans-serif;"
      },
      colors:{
        'second': {
          DEFAULT: '#FF9900',
          50: '#FFD9A1',
          100: '#FFD28F',
          200: '#FFC46B',
          300: '#FFB647',
          400: '#FFA724',
          500: '#FF9900',
          600: '#DB8400',
          700: '#B86E00',
          800: '#945900',
          900: '#704300',
          950: '#5E3900'
        },
        'primary': {
          DEFAULT: '#627289',
          50: '#CAD0D9',
          100: '#BEC6D1',
          200: '#A6B1C0',
          300: '#8E9CAF',
          400: '#76879E',
          500: '#627289',
          600: '#4A5769',
          700: '#333C48',
          800: '#1C2027',
          900: '#040506',
          950: '#000000'
        },
        'third': {
          DEFAULT: '#637B88',
          50: '#FFFFFF',
          100: '#FFFFFF',
          200: '#FFFFFF',
          300: '#EDF1F2',
          400: '#D6DDE1',
          500: '#BECAD0',
          600: '#A6B6BF',
          700: '#8FA3AE',
          800: '#77909D',
          900: '#637B88',
          950: '#576C78'
},
        
      }
    },

  },
  plugins: [[require("daisyui")],
  ],
}

