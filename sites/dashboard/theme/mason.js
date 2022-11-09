const mason = require('@joomlatools/mason-tools-v1');

async function postcss() {
  await mason.css.process(`css/input.css`, `css/output.css`, {
    tailwind: {    
      purge: {
        enabled: true,
        content: [
          '../**/*.html.php',
        ],
        options: {
          safelist: [
            // body tag
            'antialiased',
            'bg-gray-100',
            // logo icon
            'w-6',
            'h-6',
            // Platform colors
            'bg-jtblue-200',
            'text-jtblue-600',
            'bg-red-200',
            'text-red-600',
            'bg-green-200',
            'text-green-600',
            'bg-yellow-200',
            'text-yellow-600',
            'bg-purple-200',
            'text-purple-600',
            'bg-jtblue-200',
            'text-jtblue-600',
          ],
        },
      },
      theme: {
        extend: {
          colors: {
            // Joomlatools blue
            'brand': '#00adef',
            'jtblue': {
              '50':  '#f2fafc',
              '100': '#ddf8fa',
              '200': '#b1eef6',
              '300': '#7bdef2',
              '400': '#37c1ee',
              '500': '#00adef',
              '600': '#0f7bd5',
              '700': '#1362b0',
              '800': '#134a81',
              '900': '#113c63',
            },
          },
          fontFamily: {
          // Joomlatools webfont
            'jt': ['VAGRoundedTL-Regular', '"Arial Rounded"', 'sans-serif'],
          },
        }
      },
      variants: {
        opacity: ['responsive', 'hover'],
        borderWidth: ['responsive', 'hover', 'focus'],
      },
      plugins: [
        // require('@tailwindcss/typography'),
      ],
    },

    postcssPresetEnv: {
      stage: 2, // default is 2 (A Working Draft championed by a W3C Working Group.)
      autoprefixer: { cascade: true },
      features: {
          //'focus-within-pseudo-class': false, // Uncomment this if purge is set to false - See troubleshooting below
      },
    }, 

    postcssImport: {
      //root: process.cwd() //define the root where to resolve path (eg: place where node_modules are)
    },

    plugins: [
      // add your own postcss plugins here
      // they will run after postcss-import and  before other default plugins
      require('postcss-nested'), 
    ]

  });
}

async function sync() {
  mason.browserSync({
    watch: true,
    server: {
       baseDir: './sites/dashboard/theme'
    },
    files: 'css/*.css',
  });
}

module.exports = {
  version: '1.0',
  tasks: {
    postcss,
    sync,
    watch: {
      path: ['.'],
      callback: async (path) => {
        if (path.endsWith('css/input.css')) {
          await postcss();
        }
      },
    },
  },
};
