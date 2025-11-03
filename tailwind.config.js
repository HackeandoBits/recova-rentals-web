import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      keyframes: {
        'pulse-glow': {
          '20%': { boxShadow: '0 0 5px rgba(230,76,204,0.1)' },
          '50%': { boxShadow: '0 0 25px rgba(230,76,204,0.7)' },
          '100%': { boxShadow: '0 0 5px rgba(230,76,204,0.2)' },
        },
      },
      animation: {
        'pulse-glow': 'pulse-glow 2s ease-in-out infinite',
      },
    },
  },

  plugins: [
    forms,
    // Plugin para text-shadow
    function ({ addUtilities }) {
      addUtilities({
        '.text-shadow-sm': { 'text-shadow': '1px 1px 2px rgba(0,0,0,0.3)' },
        '.text-shadow': { 'text-shadow': '2px 2px 4px rgba(0,0,0,0.5)' },
        '.text-shadow-lg': { 'text-shadow': '8px 8px 8px rgba(0,0,0,0.6)' },
      }, ['responsive', 'hover']);
    },
  ],
};
