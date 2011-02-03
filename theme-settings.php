<?php
// $Id:

// Settings for the Layoutstudio theme

/**
* Implementation of THEMENAME_form_system_theme_settings_alter() function.
*/
function layoutstudio_form_system_theme_settings_alter(&$form, &$form_state) {
  // Retrieve the theme key for the theme being edited. This value will be either 'layoutstudio' or the name of a
  // layoutstudio sub-theme.
  $theme_key = $form_state['build_info']['args'][0];

	// Add the form's CSS
  drupal_add_css(drupal_get_path('theme', 'layoutstudio') . '/css/theme-settings.css', 'file');

  // Create the form widgets using Forms API
  $form['layoutstudio_random_class'] = array(
    '#type' => 'textfield',
    '#title' => t('Body and Block class from random-1 to n'),
    '#default_value' => theme_get_setting('layoutstudio_random_class', $theme_key),
    '#description' => t('This random number will appear as a body/block class that can be used to make a site more dynamic with CSS. For example, can be useful for creating header with rotating images on refresh. <strong>Value needs to be greater than one.</strong>'),
    '#weight' => '-1',
  );

  // LayoutStudio does not use the logo upload feature; add empty form elements to prevent notices generated by Drupal core
  // code which assumes that these elements always exist.
  $form['logo_path'] = array(
    '#type' => 'value',
    '#value' => '',
  );
  $form['logo_upload'] = array(
    '#type' => 'value',
    '#value' => '',
  );

  // Add layout specific theme settings.
  $form = array_merge($form, layoutstudio_layout_settings_form($form, $form_state, $theme_key));
}

/**
 * Layout specific portion of the theme settings form.
 *
 * Note: This form is also used by LayoutStudio Extras, so any elements added here could be overridable.
 */
function layoutstudio_layout_settings_form($form, &$form_state, $theme_key) {
  $form = array();
  
  $form['layoutstudio_layouts'] = array(
    '#type' => 'fieldset',
    '#title' => t('Select Layout'),
    '#description' => t('<p>Choose a predefined layout for the Primary, Secondary and Tertiary regions of the site.<p>
      <p style="margin-bottom: 0;">Color reference for Primary, Secondary & Tertiary regions:</p>
      <ul class="color-reference layouts">
            <li class="primary-region">Primary</li>
            <li class="secondary-region">Secondary</li>
            <li class="tertiary-region">Tertiary</li>
      </ul class="color-reference">
    '),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['layoutstudio_layouts']['layoutstudio_layout'] = array(
    '#type' => 'radios',
    '#options' => array(
      "layout1" => t('<strong>Layout #1</strong>') . '<div class="layout-example layout-1"><div class="secondary-region"></div><div class="primary-region">1</div><div class="tertiary-region"></div></div>' . t('<p class="layout-type")>Three column layout with secondary on the left and tertiary on the right of the main content area.</p>'),
      "layout2" => t('<strong>Layout #2</strong>') . '<div class="layout-example layout-2"><div class="tertiary-region"></div><div class="primary-region">2</div><div class="secondary-region"></div></div>' . t('<p class="layout-type")>Three column layout with tertiary on the left and secondary on the right of the main content area.</p>'),
      "layout3" => t('<strong>Layout #3</strong>') . '<div class="layout-example layout-3"><div class="primary-region">3</div><div class="secondary-region"></div><div class="tertiary-region"></div></div>' . t('<p class="layout-type")>Three column layout with secondary and tertiary to the right of the main content area.</p>'),
      "layout4" => t('<strong>Layout #4</strong>') . '<div class="layout-example layout-4"><div class="primary-region">4</div><div class="tertiary-region"></div><div class="secondary-region"></div></div>' . t('<p class="layout-type")>Three column layout with tertiary and secondary to the right of the main content area.</p>'),
      "layout5" => t('<strong>Layout #5</strong>') . '<div class="layout-example layout-5"><div class="secondary-region"></div><div class="tertiary-region"></div><div class="primary-region">5</div></div>' . t('<p class="layout-type")>Three column layout with secondary and tertiary on the left of the main content area.</p>'),
      "layout6" => t('<strong>Layout #6</strong>') . '<div class="layout-example layout-6"><div class="tertiary-region"></div><div class="secondary-region"></div><div class="primary-region">6</div></div>' . t('<p class="layout-type")>Three column layout with tertiary and secondary on the left of the main content area.</p>'),
      "layout7" => t('<strong>Layout #7</strong>') . '<div class="layout-example layout-7"><div class="primary-region">7</div><div class="secondary-region"></div><div class="tertiary-region"></div></div>' . t('<p class="layout-type")>Secondary and tertiary as two columns below main content area.</p>'),
      "layout8" => t('<strong>Layout #8</strong>') . '<div class="layout-example layout-8"><div class="primary-region">8</div><div class="secondary-region"></div><div class="tertiary-region"></div></div>' . t('<p class="layout-type")>No columns. Primary, secondary and tertiary display full width in semantic order.</p>'),
    ),
    '#default_value' => theme_get_setting('layoutstudio_layout', $theme_key),
    '#attributes' => array('class' => array('layouts')),
  );

  $form['layoutstudio_dimensions'] = array(
    '#type' => 'fieldset',
    '#title' => t('Set Dimensions'),
    '#description' => t('<p>Choose dimensions for a Page and for the Secondary and Tertiary regions of the site.'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['layoutstudio_dimensions']['layoutstudio_page_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Page width'),
    '#description' => t('Enter the desired width of the page, in pixels.'),
    '#required' => TRUE,
    '#default_value' => theme_get_setting('layoutstudio_page_width', $theme_key),
    '#field_suffix' => t('px'),
  );

  $form['layoutstudio_dimensions']['layoutstudio_secondary_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Secondary region width'),
    '#description' => t('Enter the desired width of the Secondary region, in pixels.'),
    '#required' => FALSE,
    '#default_value' => theme_get_setting('layoutstudio_secondary_width', $theme_key),
    '#field_suffix' => t('px'),
  );

  $form['layoutstudio_dimensions']['layoutstudio_tertiary_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Tertiary region width'),
    '#description' => t('Enter the desired width of the Tertiary region, in pixels.'),
    '#required' => FALSE,
    '#default_value' => theme_get_setting('layoutstudio_tertiary_width', $theme_key),
    '#field_suffix' => t('px'),
  );

  $form['layoutstudio_header_footer'] = array(
    '#type' => 'fieldset',
    '#title' => t('Header & Footer width'),
    '#description' => t('<p>Choose if you want the header and footer to take up the entire width of the browser window.'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['layoutstudio_header_footer']['layoutstudio_header_width'] = array(
    '#type' => 'checkbox',
    '#title' => t('Make header take full browser width'),
    '#required' => FALSE,
    '#default_value' => theme_get_setting('layoutstudio_header_width', $theme_key),
  );

  $form['layoutstudio_header_footer']['layoutstudio_footer_width'] = array(
    '#type' => 'checkbox',
    '#title' => t('Make footer take full browser width'),
    '#required' => FALSE,
    '#default_value' => theme_get_setting('layoutstudio_footer_width', $theme_key),
  );

  drupal_add_js(
    "
    (function ($) {
      Drupal.behaviors.layoutstudioThemeSettings = {
        attach : function(context, settings) {
          $('input[name=layoutstudio_layout]').change(function() {
            if ($(this).attr('checked')) {
              var layout = $(this).attr('value');

              if (layout == 'layout7') {
                $('.form-item-layoutstudio-secondary-width').show();
                $('.form-item-layoutstudio-tertiary-width').hide();
              }
              else if (layout == 'layout8') {
                $('.form-item-layoutstudio-secondary-width').hide();
                $('.form-item-layoutstudio-tertiary-width').hide();
              }
              else {
                $('.form-item-layoutstudio-secondary-width').show();
                $('.form-item-layoutstudio-tertiary-width').show();
              }
            }
          });
        }
      }
    })(jQuery);
    ",
    "inline"
  );

  return $form;
}