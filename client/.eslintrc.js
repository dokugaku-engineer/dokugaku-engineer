module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
    es6: true,
    jest: true
  },
  parserOptions: {
    parser: 'babel-eslint'
  },
  extends: [
    "eslint:recommended",
    "plugin:vue/recommended",
    "plugin:prettier/recommended"
  ],
  // *.vue ファイルを lint にかける
  plugins: [
    'vue'
  ],
  // ここにカスタムルールを追加
  rules: {
    "semi": [2, "never"],
    "no-console": "off",
    "vue/max-attributes-per-line": "off",
    "vue/singleline-html-element-content-newline": "off",
    "vue/html-self-closing": ["error", {
      "html": {
        "void": "always",
      }
    }],
    "prettier/prettier": ["error", {}]
  }
}
