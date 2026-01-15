/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'reunion-blue': '#007dc5',
        'reunion-yellow': '#ffd100',
        'reunion-red': '#d62b1e',
        'reunion-green': '#009150',
      },
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      {
        reunion: {
          "primary": "#007dc5",
          "secondary": "#ffd100",
          "accent": "#d62b1e",
          "neutral": "#3d4451",
          "base-100": "#ffffff",
          "info": "#3abff8",
          "success": "#009150",
          "warning": "#fbbd23",
          "error": "#f87272",
        },
      },
      "light",
    ],
  },
}
