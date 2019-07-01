# Laughland Jones

> This site uses the [`Tonik Boilerplate`](//github.com/tonik/wordpress-theme-boilerplate/).

 What's inside?

- [Gulp](//gulpjs.com/) - Task runner
- [SASS](//sass-lang.com/) - a CSS preprocessor
- [Babel](//babeljs.io/) - JavaScript ES6 to ES5 compiler
- [Rollup](//rollupjs.org/) - a JavaScript Modules Bundler
- [Stylelint](//stylelint.io/) - a SCSS linter
- [ESLint](//eslint.org/) - a JavaScript linter
- [PHP_CodeSniffer](//github.com/squizlabs/PHP_CodeSniffer) - a PHP sniffer

The front-end builder was borrowed from the Tonik [html-frontend-boilerplate](https://github.com/tonik/html-frontend-boilerplate) project.

### Requirements

Boilerplate follows a [WordPress minimal requirements](https://wordpress.org/about/requirements/). Make sure you have these dependencies installed before moving on:
- PHP >= 5.2.4

Theme uses [NPM](//www.npmjs.com/) as a front-end dependency manager. Make sure your development machine has installed following dependencies:
- [Node.js](//nodejs.org/)
- [NPM](//www.npmjs.com/)

## Installation

Install the WordPress theme to the `wp-content/themes` folder.

## Development

A [Gulp](https://gulpjs.com/) task runner is used to compile and optimize theme's scripts, stylesheets, and images.

#### Resolving front-end dependencies

Before being able to build theme you have to resolve required dependencies.

```bash
# @ wp-content/themes/laughlandjones

# Install node dependencies.
$ npm install
```

Now you have all the packages necessary to run the build process and start developing your theme.

#### Building a Theme

There are a few available commands which help you to build the theme for different environments:

```bash
# @ wp-content/themes/laughlandjones

# Compiles unminified and unoptimized theme assets with source maps.
$ npm run development

# Alias for `development` command.
$ npm run dev

# Compiles minified and optimized theme assets without source maps.
$ npm run production

# Alias for `production` command.
$ npm run prod

# Builds assets for development, runs watcher (recompiles on change)
# and BrowserSync (refreshes browser).
$ npm run watch
```

## License

The Tonik WordPress Theme Boilerplate is licensed under the [MIT license](http://opensource.org/licenses/MIT).
