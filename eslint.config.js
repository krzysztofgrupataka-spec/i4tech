import js from '@eslint/js';
import stylistic from '@stylistic/eslint-plugin';
import globals from 'globals';
import reactHooks from 'eslint-plugin-react-hooks';
import tseslint from 'typescript-eslint';
import prettier from 'eslint-config-prettier';

export default tseslint.config(
  js.configs.recommended,
  ...tseslint.configs.strict,
  prettier,
  {
    files: ['resources/**/*.{ts,tsx}'],
    languageOptions: {
      ecmaVersion: 2022,
      globals: {
        ...globals.browser,
        wp: 'readonly',
      },
    },
    plugins: {
      '@stylistic': stylistic,
      'react-hooks': reactHooks,
    },
    rules: {
      ...reactHooks.configs.recommended.rules,
      '@stylistic/quotes': ['error', 'single', { avoidEscape: true }],
      '@stylistic/semi': ['error', 'always'],
      '@typescript-eslint/consistent-type-imports': 'error',
      '@typescript-eslint/no-confusing-void-expression': 'off',
    },
  },
);
