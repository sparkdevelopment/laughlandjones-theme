# eslint-config

> A shareable ESlint config for JavaScript used at Tonik

## Install

```bash
npm install @tonik/eslint-config --save-dev
```

## Usage

Shareable configs are designed to work with the `extends` feature of `.eslintrc` files. You can learn more about [Shareable Configs](http://eslint.org/docs/developer-guide/shareable-configs) on the official ESLint website.

To use a shareable config, first run this:

```bash
npm install --save-dev @tonik/eslint-config eslint-config-standard eslint-plugin-standard eslint-plugin-promise eslint-plugin-import eslint-plugin-node
```

Then, add this to your .eslintrc file:

```
{
  "extends": "@tonik/eslint-config"
}
```

You can override settings from the shareable config by adding them directly into your
`.eslintrc` file.

## License

Licensed under the [MIT license](http://opensource.org/licenses/MIT).
