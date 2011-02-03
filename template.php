<?php
// $Id: template.php,v 1.1.4.12 2011/01/11 17:38:21 rjay Exp $

/**
 * CSS Reset and default styling
 */
drupal_add_css(drupal_get_path('theme', 'layoutstudio') . '/css/defaults.css', array('weight' => CSS_THEME, 'type' => 'file'));
drupal_add_css(drupal_get_path('theme', 'WORKING_COPY') . '/css/defaults_ie.css', array('weight' => CSS_THEME, 'browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE), 'preprocess' => FALSE));

function layoutstudio_preprocess_html(&$variables) {  
  // Set up layout variable.
  $variables['layout'] = 'no-secondary-and-tertiary';
  if (!empty($variables['page']['secondary_first']) OR !empty($variables['page']['secondary']) OR !empty($variables['page']['secondary_last'])) {
    $variables['layout'] = 'no-tertiary';
  }
  if (!empty($variables['page']['tertiary_first']) OR !empty($variables['page']['tertiary']) OR !empty($variables['page']['tertiary_last'])) {
    $variables['layout'] = ($variables['layout'] == 'no-tertiary') ? 'regions-all' : 'no-secondary';
  }
  $variables['preface_class'] = 'no-preface';
  if (!empty($variables['page']['preface_first']) OR !empty($variables['page']['preface']) OR !empty($variables['page']['preface_last'])) {
    $variables['preface_class'] = 'no-preface';
  }
  $variables['postscript_class'] = 'no-postscript';
  if (!empty($variables['page']['postscript_first']) OR !empty($variables['page']['postscript']) OR !empty($variables['page']['postscript_last'])) {
    $variables['postscript_class'] = 'no-postscript';
  }

  // Compile an array of classes that are going to be applied to the body element.
  // This allows advanced theming based on context (home page, node of certain type, etc.).
  // Random body class
  $random = theme_get_setting('layoutstudio_random_class');
  if ($random > 1){
    $variables['classes_array'][] = 'random-'.rand(1, $random);
  }
  // Current active menu item
 	$variables['classes_array'][] = 'menu-item-'. drupal_clean_css_identifier(drupal_strtolower(menu_get_active_title()));
  // Add information regarding the secondary & tertiary.
  if ($variables['layout'] == 'regions-all') {
    $variables['classes_array'][] = 'regions-all';
  }
  elseif ($variables['layout'] == 'no-secondary-and-tertiary') {
    $variables['classes_array'][] = 'no-secondary-and-tertiary';
  }
  else {
    $variables['classes_array'][] = $variables['layout'];
  }
  $variables['classes_array'][] = $variables['preface_class'];
  $variables['classes_array'][] = $variables['postscript_class'];

  if (!$variables['is_front']) {
		// Add unique classes for each page and website section
		$path = drupal_get_path_alias($_GET['q']);
    $section = arg(0);
    $sub_section = arg(1);
		$variables['classes_array'][] = 'section-'. $section;
		$variables['classes_array'][] = 'sub-section-'. ($sub_section ? $sub_section : 'none');
		if (arg(0) == 'node') {
			if (arg(1) == 'add') {
				if ($section == 'node') {
					array_pop($variables['classes_array']); // Remove 'section-node'
					array_pop($variables['classes_array']); // Remove 'section-node'
				}
				$variables['classes_array'][] = 'section-node-add'; // Add 'section-node-add'
			}
			elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
				if ($section == 'node') {
					array_pop($variables['classes_array']); // Remove 'section-node'
					array_pop($variables['classes_array']); // Remove 'section-node'
				}
				$variables['classes_array'][] = 'section-node-'. arg(2); // Add 'section-node-edit' or 'section-node-delete'
			}
		}
	}

  // Add classes based on the role(s) of the current user
  global $user;
  foreach ($user->roles as $role) {
    $variables['classes_array'][] = "role-".drupal_clean_css_identifier($role);
  }
}

//Setting classes for body element
function layoutstudio_preprocess_page(&$variables) {
	// Set up layout variable.
  $variables['layout'] = 'no-secondary-and-tertiary';
  if (!empty($variables['page']['secondary_first']) OR !empty($variables['page']['secondary']) OR !empty($variables['page']['secondary_last'])) {
    $variables['layout'] = 'no-tertiary';
  }
  if (!empty($variables['page']['tertiary_first']) OR !empty($variables['page']['tertiary']) OR !empty($variables['page']['tertiary_last'])) {
    $variables['layout'] = ($variables['layout'] == 'no-tertiary') ? 'regions-all' : 'no-secondary';
  }
  $variables['preface_classes_array'] = 'no-preface';
  if (!empty($variables['page']['preface_first']) OR !empty($variables['page']['preface']) OR !empty($variables['page']['preface_last'])) {
    $variables['preface_classes_array'] = 'no-preface';
  }
  $variables['postscript_classes_array'] = 'no-postscript';
  if (!empty($variables['page']['postscript_first']) OR !empty($variables['page']['postscript']) OR !empty($variables['page']['postscript_last'])) {
    $variables['postscript_classes_array'] = 'no-postscript';
  }

  // Add layout specific CSS to the page.
  layoutstudio_add_layout_css($variables);
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function layoutstudio_preprocess_maintenance_page(&$variables) {
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'layoutstudio') . '/css/maintenance-page.css');
}

//Setting classes for nodes
function layoutstudio_preprocess_node(&$variables) {
  global $user;

	// Compile an array of classes that are going to be applied to the node div.
	if ($variables['node']->uid && $variables['node']->uid == $user->uid) {
		// Node is authored by current user
		$variables['classes_array'][] = 'user-me';
	}
	//Add node's user id
	$variables['classes_array'][] = 'user-' . $variables['node']->uid;

	if ($variables['teaser']) {
		// Node is displayed as teaser
    $variables['classes_array'][] = 'node-'. $variables['node']->type.'-teaser';
	}
	else {
		$variables['classes_array'][] = 'node-full';
    $variables['classes_array'][] = 'node-'. $variables['node']->type.'-full';
	}
	//odd/even class for node listings
	$variables['classes_array'][] = $variables['zebra'];
	//node count for node listings
	$variables['classes_array'][] = 'count-' . $variables['id'];
	//Add clear fix class
	$variables['classes_array'][] = 'clearfix';

  // Add classes based on the role(s) of the node author
  $account = user_load($variables['node']->uid);
  foreach ($account->roles as $role) {
    $variables['classes_array'][] = "role-".drupal_clean_css_identifier($role);
  }
}

//Setting classes for blocks
function layoutstudio_preprocess_block(&$variables) {
  // Random block class
  $random = theme_get_setting('layoutstudio_random_class');
  if ($random > 1){
    $variables['classes_array'][] = 'random-'.rand(1, $random);
  }
  $variables['classes_array'][] = $variables['block_zebra'];
  $variables['classes_array'][] = 'region-count-'. $variables['block_id'];
	//Add clear fix class
	$variables['classes_array'][] = 'clearfix';
	$variables['title_attributes_array']['class'][] = 'block-title';
}

// Setting classes for comments
function layoutstudio_preprocess_comment(&$variables) {
  static $comment_counter = array();

  if (!isset($comment_counter[$variables['node']->nid])) {
    $comment_counter[$variables['node']->nid] = 1;
  }
  $variables['classes_array'][] = ($comment_counter[$variables['node']->nid] % 2) ? 'odd' : 'even';
  $variables['classes_array'][] = 'comment-'.$variables['comment']->cid;
  $comment_counter[$variables['node']->nid]++;

  // Add classes based on the role(s) of the comment author
  $account = user_load($variables['comment']->uid);
  foreach ($account->roles as $role) {
    $variables['classes_array'][] = "role-".drupal_clean_css_identifier($role);
  }
}

function layoutstudio_add_layout_css(&$variables) {
  // Add dimensions and other layout specific styles.
  $layout = layoutstudio_theme_get_setting('layoutstudio_layout');
  $page_width = layoutstudio_theme_get_setting('layoutstudio_page_width');
  $secondary_width = layoutstudio_theme_get_setting('layoutstudio_secondary_width');
  $tertiary_width = layoutstudio_theme_get_setting('layoutstudio_tertiary_width');
  $header_width = layoutstudio_theme_get_setting('layoutstudio_header_width');
  $footer_width = layoutstudio_theme_get_setting('layoutstudio_footer_width');

  // Width calculations for certain layouts
  if ($layout == "layout7") {
    $tertiary_width = $page_width - $secondary_width;
  }

	// Specify page width
	if ($header_width == 1 OR $footer_width == 1) {
		$data = '#container {width: '. $page_width .'px;}';
		if ($header_width == 1 && $footer_width == 1) {
			$data .= '#header .inside, #footer .inside {width: '. $page_width .'px; margin: 0 auto;}';
		}
		if ($header_width == 1 && $footer_width == 0) {
			$data .= '#header .inside {width: '. $page_width .'px; margin: 0 auto;}';
			$data .= '#footer {width: '. $page_width .'px; margin: 0 auto;}';
		}
		if ($header_width == 0 && $footer_width == 1) {
			$data .= '#footer .inside {width: '. $page_width .'px; margin: 0 auto;}';
			$data .= '#header {width: '. $page_width .'px; margin: 0 auto;}';
		}
	}
	else {
		$data = '#page,#container {width: '. $page_width .'px;}';
	}


	if ($layout != 'layout8') {

		if ($layout != 'layout7') {
      // Specify wrapper div settings
			$data .= '#wrapper {float: left; width: 100%;}';

		  // Specify primary div settings
			$data .= '#primary {';

      if ($layout == 'layout1') {
        $data .= '
          margin-left: '. $secondary_width .'px;
          margin-right: '. $tertiary_width .'px;
        ';
      }

      if ($layout == 'layout2') {
        $data .= '
          margin-left: '. $tertiary_width .'px;
          margin-right: '. $secondary_width .'px;
        ';
      }

      if ($layout == 'layout3' OR $layout == 'layout4') {
        $margin_right_width = $secondary_width + $tertiary_width;
        $data .= 'margin-right: '. $margin_right_width  .'px;';
      }

      if ($layout == 'layout5' OR $layout == 'layout6') {
        $margin_left_width = $secondary_width + $tertiary_width;
        $data .= 'margin-left: '. $margin_left_width  .'px;';
      }

			$data .= '}';
		}

		// Specify secondary div settings
		$data .= '
			#secondary {
				float: left;
				width: '. $secondary_width .'px;
		';

    if ($layout == 'layout1' OR $layout == 'layout5') {
      $data .= 'margin-left: -'. $page_width .'px;';
    }
    if ($layout == 'layout2' OR $layout == 'layout4') {
      $data .= 'margin-left: -'. $secondary_width .'px;';
    }
    if ($layout == 'layout3') {
      $margin_left_width = $secondary_width + $tertiary_width;
      $data .= 'margin-left: -'. $margin_left_width .'px;';
    }
    if ($layout == 'layout6') {
      $margin_left_width = $page_width - $tertiary_width;
      $data .= 'margin-left: -'. $margin_left_width .'px;';
    }

		$data .= '}';

		// Specify tertiary div settings
		$data .= '
			#tertiary {
				width: '. $tertiary_width .'px;
		';

    if ($layout == 'layout1' OR $layout == 'layout3') {
      $data .= 'margin-left: -'. $tertiary_width .'px;';
    }
    if ($layout == 'layout2') {
      $data .= 'margin-left: -'. $page_width .'px;';
    }
    if ($layout == 'layout4') {
      $margin_left_width = $secondary_width + $tertiary_width;
      $data .= 'margin-left: -'. $margin_left_width .'px;';
    }
    if ($layout == 'layout5') {
      $margin_left_width = $page_width - $secondary_width;
      $data .= 'margin-left: -'. $margin_left_width .'px;';
    }
    if ($layout == 'layout6') {
      $data .= 'margin-left: -'. $page_width .'px;';
    }
    if ($layout != 'layout7')	{
			$data .= 'float: left;';
		}
		if ($layout == 'layout7')	{
			$data .= 'float: right;';
		}

		$data .= '}';

		// Specify adjustments on pages with no secondary content
		if (!$variables['page']['secondary_first'] && !$variables['page']['secondary'] && !$variables['page']['secondary_last']) {
			if ($layout == 'layout1') {
				$data .= '.no-secondary #primary {margin-left: 0;}';
			}
			if ($layout == 'layout2') {
				$data .= '.no-secondary #primary {margin-right: 0;}';
			}
			if ($layout == 'layout3' OR $layout == 'layout4') {
				$data .= '.no-secondary #primary {margin-right: '. $tertiary_width .'px;}';
			}
			if ($layout == 'layout4') {
				$data .= '.no-secondary #tertiary {margin-left: -'. $tertiary_width .'px;}';
			}
			if ($layout == 'layout5') {
				$data .= '.no-secondary #primary {margin-right: 0;}';
				$data .= '.no-secondary #primary {margin-left: '. $tertiary_width .'px;}';
			}
			if ($layout == 'layout6' OR $layout == 'layout5') {
				$data .= '.no-secondary #tertiary {margin-left: -'. $page_width .'px;}';
			}
			if ($layout == 'layout6') {
				$data .= '.no-secondary #primary {margin-left: '. $tertiary_width .'px;}';
			}
			if ($layout == 'layout7') {
				$data .= '.no-secondary #tertiary {float: none; width: auto;}';
			}
		}

		// Specify adjustments on pages with no tertiary content
		if (!$variables['page']['tertiary_first'] && !$variables['page']['tertiary'] && !$variables['page']['tertiary_last']) {
			if ($layout == 'layout1') {
				$data .= '.no-tertiary #primary {margin-right: 0;};';
				$margin_left_width = $page_width - $secondary_width;
				$data .= '.no-tertiary #secondary {margin-left: -'. $margin_left_width .'px;}';
			}
			if ($layout == 'layout2') {
				$data .= '.no-tertiary #primary {margin-left: 0;};';
			}
			if ($layout == 'layout3') {
				$data .= '.no-tertiary #primary {margin-right: '. $secondary_width .'px;}';
				$data .= '.no-tertiary #secondary {margin-left: -'. $secondary_width .'px;}';
			}
			if ($layout == 'layout4') {
				$data .= '.no-tertiary #primary {margin-right: '. $tertiary_width .'px;}';
				$data .= '.no-tertiary #secondary {margin-left: -'. $tertiary_width .'px;}';
			}
			if ($layout == 'layout5') {
				$data .= '.no-tertiary #primary {margin-left: '. $secondary_width .'px;}';
			}
			if ($layout == 'layout6') {
				$data .= '.no-tertiary #primary {margin-left: '. $secondary_width .'px;}';
				$data .= '.no-tertiary #secondary {margin-left: -'. $page_width .'px;}';
			}
			if ($layout == 'layout7') {
				$data .= '.no-tertiary #secondary {float: none; width: auto;}';
			}
		}

		// Specify adjustments on pages with no secondary and no tertiary content
		if (!$variables['page']['secondary_first'] && !$variables['page']['secondary'] && !$variables['page']['secondary_last'] && !$variables['page']['tertiary_first'] && !$variables['page']['tertiary'] && !$variables['page']['tertiary_last']) {

			if ($layout == 'layout3' OR $layout == 'layout4' OR $layout == 'layout5') {
				$data .= '.no-secondary-and-tertiary #primary {margin-right: '. $tertiary_width .'px;};';
			}
			if ($layout == 'layout4') {
				$data .= '.no-secondary-and-tertiary #tertiary {margin-left: -'. $tertiary_width .'px;};';
			}
			if ($layout == 'layout5' OR $layout == 'layout6') {
				$data .= '.no-secondary-and-tertiary #tertiary {margin-left: -'. $page_width .'px;};';
			}
			if ($layout == 'layout6') {
				$data .= '.no-secondary-and-tertiary #primary {margin-left: '. $tertiary_width .'px;};';
			}

			if ($layout == 'layout1') {
				$margin_left_width = $page_width - $secondary_width;
				$data .= '.no-secondary-and-tertiary #secondary {margin-left: -'. $margin_left_width .'px;}';
			}
			if ($layout == 'layout3') {
				$data .= '.no-secondary-and-tertiary #primary {margin-right: '. $secondary_width .'px;}';
				$data .= '.no-secondary-and-tertiary #secondary {margin-left: -'. $secondary_width .'px;}';
			}
			if ($layout == 'layout4') {
				$data .= '.no-secondary-and-tertiary #primary {margin-right: '. $tertiary_width .'px;}';
				$data .= '.no-secondary-and-tertiary #secondary {margin-left: -'. $tertiary_width .'px;}';
			}
			if ($layout == 'layout5') {
				$data .= '.no-secondary-and-tertiary #primary {margin-right: '. $secondary_width .'px;}';
			}
			if ($layout == 'layout6') {
				$data .= '.no-secondary-and-tertiary #primary {margin-left: '. $secondary_width .'px;}';
				$data .= '.no-secondary-and-tertiary #secondary {margin-left: -'. $page_width .'px;}';
			}

			if ($layout != 'layout7') {
				$data .= '.no-secondary-and-tertiary #wrapper {float: none; width: auto;}';
				$data .= '.no-secondary-and-tertiary #primary {margin: 0;}';
			}
		}
	}

  drupal_add_css($data, array('type' => 'inline'));
}

/**
 * Helper function that loads a theme setting. Using this function allows for theme settings to be overridden on specific
 * pages via the LayoutStudio Extras module.
 */
function layoutstudio_theme_get_setting($setting_name) {
  if (module_exists('layoutstudio_extras')) {
    if (function_exists('layoutstudio_extras_theme_get_setting')) {
      // Load a theme setting via the LayoutStudio Extras companion module, which will determine if a default setting has
      // been overridden via an adjustment for the current page.
      return layoutstudio_extras_theme_get_setting($setting_name);
    }
  }

  // Load the setting the normal way if LayoutStudio Extras is not installed.
  return theme_get_setting($setting_name);
}