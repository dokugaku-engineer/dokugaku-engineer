module.exports = {
  transform: {
    '^.+\\.js$': 'babel-jest',
    '.*\\.(vue)$': 'vue-jest'
  },
  moduleNameMapper: {
    '^@/(.*)$': '<rootDir>/$1',
    '^~/(.*)$': '<rootDir>/$1'
  },
  moduleFileExtensions: [
    'js',
    'json',
    'vue'
  ],
  "collectCoverageFrom": [
    "**/*.{js,vue}",
    "!**/node_modules/**",
  ],
  "setupFiles": [
    "dotenv/config"
  ]
}
