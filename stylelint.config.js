export default {
  extends: ['stylelint-config-standard-scss'],
  rules: {
    'at-rule-empty-line-before': null,
    'custom-property-pattern': null,
    'declaration-empty-line-before': null,
    'max-nesting-depth': 3,
    'selector-class-pattern': [
      '^[a-z][a-z0-9]*(?:-[a-z0-9]+)*(?:__(?:[a-z0-9]+-?)+)?(?:--(?:[a-z0-9]+-?)+)?$|^is-|^has-|^wp-',
      {
        message: 'Use BEM-light class names, state classes, or WordPress core classes.',
      },
    ],
  },
};
