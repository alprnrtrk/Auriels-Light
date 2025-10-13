import defaultTheme from 'tailwindcss/defaultTheme';

export default {
	content: [
		'./*.php',
		'./inc/**/*.php',
		'./partials/**/*.php',
		'./templates/**/*.php',
		'./assets/src/js/**/*.js',
	],
	theme: {
		container: {
			center: true,
			padding: {
				DEFAULT: '1.5rem',
				lg: '2rem',
			},
		},
		extend: {
			colors: {
				brand: '#2563eb',
			},
			fontFamily: {
				sans: ['Inter', ...defaultTheme.fontFamily.sans],
			},
		},
	},
	plugins: [],
};
