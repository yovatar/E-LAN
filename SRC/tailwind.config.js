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
      }
    },
  },
  variants: {
    extend: {
      margin: ['first', 'last'],
      backgroundColor: ['odd', 'even'],
      textColor: ['odd', 'even'],
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
      patterns: ["diagonal-lines"],

      // The foreground colors of the pattern
      colors: {
        default: "#9C92AC",
        "pink": colors.purple["500"] //also works with rgb(0,0,205)
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
