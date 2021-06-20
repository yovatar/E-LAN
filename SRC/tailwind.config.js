const { colors } = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [
    './view/**/*.php',
    './view/**/*.html',
    './app/**/*.ts',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        blueGray: {
          50: '#F8FAFC',
          100: '#F1F5F9',
          200: '#E2E8F0',
          300: '#CBD5E1',
          400: '#94A3B8',
          500: '#64748B',
          600: '#475569',
          700: '#334155',
          800: '#1E293B',
          900: '#0F172A'
        }
      },
      spacing: {
        '18': '4.5rem',
        '30': '7.5rem',
        '42': '10.5rem',
        '54': '13.5rem',
        '128': '32rem',
        '144': '36rem',
        '1/24': '4.166666%',
        '2/24': '8.333333%',
        '3/24': '12.5%',
        '4/24': '16.666666%',
        '5/24': '20.833333%',
        '6/24': '25%',
        '7/24': '29.166666%',
        '8/24': '33.333333%',
        '9/24': '37.5%',
        '10/24': '41.666666%',
        '11/24': '45.833333%',
        '12/24': '50%',
        '13/24': '54.166666%',
        '14/24': '58.333333%',
        '15/24': '62.5%',
        '16/24': '66.666666%',
        '17/24': '70.833333%',
        '18/24': '75%',
        '19/24': '79.166666%',
        '20/24': '83.333333%',
        '21/24': '87.5%',
        '22/24': '91.666666%',
        '23/24': '95.833333%',
        '24/24': '100%',
      },
      strokeWidth: {
        '3': '3',
        '4': '4',
      },
      minHeight:{
        '0':'0',
        'full':'100%',
        'screen':'100vh',
        '48':'12rem',
        '64':'16rem',
        '72':'18rem',
        '128':'32rem',
      },
      keyframes: {
        wiggle: {
          '0%, 100%': { transform: 'translateX(-0.5rem)' },
          '50%': { transform: 'translateX(0.5rem)' }
        },
        'wiggle-reverse': {
          '0%, 50%': { transform: 'translateX(0.5rem)' },
          '50%': { transform: 'translateX(-0.5rem)' }
        },
      },
      animation: {
        wiggle: 'wiggle 1.5s ease-in-out infinite',
        'wiggle-reverse': 'wiggle 1.5s ease-in-out infinite',
      },
    },
  },
  variants: {
    extend: {
      margin: ['first', 'last'],
      backgroundColor: ['odd', 'even'],
      textColor: ['odd', 'even'],
      brightness: ['hover', 'focus'],
      animation: ['hover', 'focus'],
      strokeWidth: ['hover', 'focus'],
      dropShadow: ['hover', 'focus'],
      borderWidth: ['hover', 'focus'],
      borderStyle: ['hover', 'focus'],
      backgroundColor: ['active'],
      textColor: ['active'],
      ringColor: ['active'],
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio'),
    require("tailwind-heropatterns")({
      // as per tailwind docs you can pass variants
      variants: [],

      // the list of patterns you want to generate a class for
      // the names must be in kebab-case
      // an empty array will generate all 87 patterns
      patterns: ["diagonal-lines", "endless-clouds"],

      // The foreground colors of the pattern
      colors: {
        default: "#9C92AC",
        "pink": colors.purple["500"], //also works with rgb(0,0,205)
        "purple100": colors.purple["100"], 
        "purple200": colors.purple["200"], 
        "purple300": colors.purple["300"], 
        "purple400": colors.purple["400"], 
        "purple500": colors.purple["500"], 
        "purple600": colors.purple["600"], 
        "purple700": colors.purple["700"], 
        "purple800": colors.purple["800"], 
        "purple900": colors.purple["900"], 
      },

      // The foreground opacity
      opacity: {
        default: "0.4",
        "10": "0.1",
        "100": "1.0",
      }
    })
  ]
}
