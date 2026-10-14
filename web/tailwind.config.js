/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Primary Green Theme - dari Style Guide
        primary: {
          50: '#f0fdf4',
          100: '#dcfce7',
          200: '#bbf7d0',
          300: '#86efac',
          400: '#4ade80',
          500: '#22c55e',
          600: '#16a34a',
          700: '#15803d',
          800: '#166534',
          900: '#14532d',
          950: '#052e16',
        },
        // Glass Colors untuk Glassmorphism
        glass: {
          light: 'rgba(255, 255, 255, 0.25)',
          DEFAULT: 'rgba(255, 255, 255, 0.15)',
          dark: 'rgba(255, 255, 255, 0.08)',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
      boxShadow: {
        // Soft shadows untuk card dan elevated elements
        'soft': '0 2px 15px -3px rgba(34, 197, 94, 0.08), 0 10px 20px -2px rgba(34, 197, 94, 0.04)',
        'soft-sm': '0 1px 8px -2px rgba(34, 197, 94, 0.06), 0 4px 10px -1px rgba(34, 197, 94, 0.03)',
        'soft-lg': '0 10px 40px -10px rgba(34, 197, 94, 0.15)',
        // Glass effect shadows
        'glass': '0 8px 32px 0 rgba(34, 197, 94, 0.15)',
        'glass-sm': '0 4px 16px 0 rgba(34, 197, 94, 0.1)',
        // Neumorphic shadows
        'neumorphic': '8px 8px 16px #c5e9d0, -8px -8px 16px #ffffff',
        'neumorphic-sm': '4px 4px 8px #c5e9d0, -4px -4px 8px #ffffff',
        'neumorphic-inset': 'inset 4px 4px 8px #c5e9d0, inset -4px -4px 8px #ffffff',
      },
      borderRadius: {
        'soft': '0.75rem',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.3s ease-out',
        'slide-down': 'slideDown 0.3s ease-out',
        'scale-in': 'scaleIn 0.2s ease-out',
        'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        slideDown: {
          '0%': { opacity: '0', transform: 'translateY(-10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        scaleIn: {
          '0%': { opacity: '0', transform: 'scale(0.95)' },
          '100%': { opacity: '1', transform: 'scale(1)' },
        },
        pulseSoft: {
          '0%, 100%': { opacity: '1' },
          '50%': { opacity: '0.7' },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
