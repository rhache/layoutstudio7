<?php
// $Id:

/**
 * DEFAULTS CSS
 * Uncommenting the following lines will override the defaults.css
 * and defaults_ie.css in the LayoutStudio base theme, allowing you
 * to user your own defaults/reset, or to simply remove them.
 * Make sure you add a defaults.css and defaults_ie.css in your theme,
 * even if it's an empty file.
 */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/defaults.css', array('weight' => CSS_THEME, 'type' => 'file'));
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/defaults_ie.css', array('weight' => CSS_THEME, 'browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE), 'preprocess' => FALSE));

/**
 * Dedicated file to add @font-face
 */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/fonts/fonts.css', array('weight' => CSS_THEME, 'type' => 'file'));

/**
 * Main Stylesheets
 */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/all.css', array('weight' => CSS_THEME, 'type' => 'file'));
drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/screen.css', array('weight' => CSS_THEME, 'media' => 'screen, projection', 'type' => 'file'));
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/print.css', array('weight' => CSS_THEME, 'media' => 'print', 'type' => 'file'));

/**
 * IE Conditional Stylesheets
 */
drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/ie/fix-ie6.css', array('weight' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/ie/fix-ie7.css', array('weight' => CSS_THEME, 'browsers' => array('IE' => 'IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/ie/fix-ie8.css', array('weight' => CSS_THEME, 'browsers' => array('IE' => 'IE 8', '!IE' => FALSE), 'preprocess' => FALSE));


/**
 * Override or insert variables into all templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess_html(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess_page(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the maintenance page template.
 * 
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess_maintenance_page(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess_node(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess_comment(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function MYTHEME_preprocess_block(&$variables) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */
