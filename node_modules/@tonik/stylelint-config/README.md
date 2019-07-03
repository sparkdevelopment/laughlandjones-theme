# stylelint-config

> A shareable stylelint config for CSS used at Tonik

## Installation

```bash
npm install @tonik/stylelint-config --save-dev
```

## Usage

If you've installed `@tonik/stylelint-config` locally within your project, just set your `stylelint` config to:

```json
{
  "extends": "@tonik/stylelint-config"
}
```

If you've globally installed `stylelint-config` using the `-g` flag, then you'll need to use the absolute path to `stylelint-config` in your config e.g.

```json
{
  "extends": "/absolute/path/to/@tonik/stylelint-config"
}
```

### Extending the config

Simply add a `"rules"` key to your config, then add your overrides and additions there.

For example, to change the `at-rule-no-unknown` rule to use its `ignoreAtRules` option, turn off the `block-no-empty` rule, and add the `unit-whitelist` rule:

```json
{
  "extends": "@tonik/stylelint-config",
  "rules": {
    "at-rule-no-unknown": [true, {
      "ignoreAtRules": [
        "extends"
      ]
    }],
    "block-no-empty": null,
    "unit-whitelist": ["em", "rem", "s"]
  }
}
```

## License

Licensed under the [MIT license](http://opensource.org/licenses/MIT).
