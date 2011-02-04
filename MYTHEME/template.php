<?php
// $Id:

/**
 * DEFAULTS CSS
 * Uncommenting the following lines will override the defaults.css
 * in the LayoutStudio base theme, allowing you
 * to user your own defaults/reset, or to simply remove them.
 * Make sure you add a defaults.css in your theme,
 * even if it's an empty file.
 */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/defaults.css', array('weight' => CSS_THEME, 'type' => 'file'));


/**
 * Main Stylesheets
 */


/**
 * Dedicated file to add @font-face
 */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/fonts/fonts.css', array('weight' => CSS_THEME, 'type' => 'file')); 

 
/* SCREEN */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/all.css', array('weight' => CSS_THEME, 'type' => 'file'));
drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/screen.css', array('weight' => CSS_THEME, 'media' => 'screen, projection', 'type' => 'file'));

/* MOBILE */
drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/mobile.css', array('weight' => CSS_THEME, 'media' => 'screen, projection', 'type' => 'file'));


/* PRINT */

//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/print.css', array('weight' => CSS_THEME, 'media' => 'print', 'type' => 'file'));


/* LESS STYLES */
/*  
  Beware.. LESS php preprocessor module is not behaving as expected. I would recommend that you compile to a less.css file using something else then the less.module and include it using a regular .css file.  
*/

/* Uncomment to enable. Make sure you have installed and enabled the LESS module */
//drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/less/MYTHEME.css.less', array('weight' => CSS_THEME, 'media' => 'screen, projection', 'type' => 'file'));

/* IF you precompile your less files */
/* drupal_add_css(drupal_get_path('theme', 'MYTHEME') . '/css/less/less.css', array('weight' => CSS_THEME, 'media' => 'screen, projection', 'type' => 'file')); */





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
