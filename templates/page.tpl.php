<?php
// $Id:

/**
 * @file
 * layoutstudio's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - regions[header]: Items for the header region.
 * - regions[preface_first]: First preface region
 * - regions[preface]: Middle preface region
 * - regions[preface_last]: Last preface region
 * - regions[highlighted]: Highlight region as recommended for Drupal 7 themes
 * - regions[help]: Help region as recommended for Drupal 7 themes
 * - regions[content]: Primary/main content area
 * - regions[secondary_first]: First secondary region
 * - regions[left]: Middle secondary region
 * - regions[secondary_last]: Last secondary region
 * - regions[tertiary_first]: First tertiary region
 * - regions[right]: Middle tertiary region
 * - regions[tertiary_last]: Last tertiary region
 * - regions[postscript_first]: First postscript region
 * - regions[postscript]: Middle postscript region
 * - regions[postscript_last]: Last postscript region
 * - regions[navigation]: Region for navigation/menu blocks
 * - regions[footer]: Site footer
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see layoutstudio_process_page()
 */
?>

<div class="skip-to-links">
	<p>
		<?php print t('Skip to: ') ?>
		<span class="skip-to-content">
			<a href="#content-area" title="<?php print t('Go to site content') ?>">content</a>
		</span>
    <?php if ($page['navigation'] OR $main_menu OR $secondary_menu): ?>
    &ndash;
    <span class="skip-to-nav">
      <a href="#nav" title="' . t('Go to site navigation') . '">navigation</a>
    </span>
    <?php endif; ?>
	</p>
</div>

<div id="page">

	<div id="header" class="clearfix">
		<div class="inside">
			
			<?php if ($logo): //Remember to enable the logo in your theme's info file ?>
				<?php if ($is_front): ?>
	        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
				<?php else: ?>
		      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
		        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
		      </a>
				<?php endif; ?>			
	    <?php endif; ?>

			<?php if ($site_name): ?>
				<p class="site-name">
					<?php if ($is_front): ?>
						<?php print $site_name; ?>	
					<?php else: ?>
						<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
							<?php print $site_name; ?>
						</a>
					<?php endif; ?>			
				</p>
			<?php endif; ?>
			
			<?php if ($site_slogan): ?>
				<p class="site-slogan"><?php print $site_slogan; ?></p>
			<?php endif; ?>
	
			<?php print render($page['header']); ?>
		
		</div><!-- CLASS inside -->
	</div><!-- ID header -->

	<div id="container" class="clearfix">

		<div id="breadcrumb"><?php if ($breadcrumb): print $breadcrumb; endif; ?></div>

		<?php if ($page['preface_first'] OR $page['preface'] OR $page['preface_last']): ?>
			<div id="preface">
      	<?php print render($page['preface_first']); ?>
      	<?php print render($page['preface']); ?>
      	<?php print render($page['preface_last']); ?>
			</div><!-- ID preface -->
		<?php endif; ?>
	
		<div id="wrapper">
			<div id="primary">
	      <div class="inside" class="clearfix">

					<a id="content-area"></a>
					
			    <?php print render($page['highlighted']); ?>
					<?php print render($page['help']); ?>
			    <?php print $messages; ?>
			          			
		      <?php print render($title_prefix); ?>
		      <?php if ($title): ?>
		        <h1 class="title" id="page-title">
		          <?php print $title; ?>
		        </h1>
		      <?php endif; ?>
		      <?php print render($title_suffix); ?>

		      <?php if ($tabs): ?>
		        <div class="tabs">
		          <?php print render($tabs); ?>
		        </div>
		      <?php endif; ?>
		      
		      <?php if ($action_links): ?>
		        <ul class="action-links">
		          <?php print render($action_links); ?>
		        </ul>
		      <?php endif; ?>

		      <?php print render($page['content']); ?>

		      <?php print $feed_icons; ?>			

	      </div><!-- CLASS inside -->
			</div><!-- ID primary -->
		</div><!-- ID wrapper -->
		
		<?php if ($page['secondary_first'] OR $page['secondary'] OR $page['secondary_last']): ?>
			<div id="secondary">
		    <?php print render($page['secondary_first']); ?>
      	<?php print render($page['secondary']); ?>
      	<?php print render($page['secondary_last']); ?>
			</div><!-- ID secondary -->
		<?php endif; ?>
	
		<?php if ($page['tertiary_first'] OR $page['tertiary'] OR $page['tertiary_last']): ?>
			<div id="tertiary">
      	<?php print render($page['tertiary_first']); ?>
      	<?php print render($page['tertiary']); ?>
      	<?php print render($page['tertiary_last']); ?>
			</div><!-- ID tertiary -->
		<?php endif; ?>

		<?php if ($page['postscript_first'] OR $page['postscript'] OR $page['postscript_last']): ?>
			<div id="postscript">
      	<?php print render($page['postscript_first']); ?>
      	<?php print render($page['postscript']); ?>
      	<?php print render($page['postscript_last']); ?>
			</div><!-- ID postscript -->
		<?php endif; ?>
		
		<?php if ($page['navigation'] OR $main_menu OR $secondary_menu): ?>
			<div id="navigation">
				<a id="nav"></a>
				
				<?php if ($main_menu): //Remember to turn menu option on in your theme's info file ?>
		      <div id="main-menu" class="navigation">
		        <?php print theme('links__system_main_menu', array(
		          'links' => $main_menu,
		          'attributes' => array(
		            'id' => 'main-menu-links',
		            'class' => array('links', 'clearfix'),
		          ),
		          'heading' => array(
		            'text' => t('Main menu'),
		            'level' => 'h2',
		            'class' => array('element-invisible'),
		          ),
		        )); ?>
		      </div> <!-- ID main-menu -->
		    <?php endif; ?>
		
		    <?php if ($secondary_menu): //Remember to turn menu option on in your theme's info file ?>
		      <div id="secondary-menu" class="navigation">
		        <?php print theme('links__system_secondary_menu', array(
		          'links' => $secondary_menu,
		          'attributes' => array(
		            'id' => 'secondary-menu-links',
		            'class' => array('links', 'inline', 'clearfix'),
		          ),
		          'heading' => array(
		            'text' => t('Secondary menu'),
		            'level' => 'h2',
		            'class' => array('element-invisible'),
		          ),
		        )); ?>
		      </div> <!-- ID secondary-menu -->
		    <?php endif; ?>

				<?php print render($page['navigation']); ?>
			</div><!-- ID navigation -->
		<?php endif; ?>

	</div><!-- ID container -->

	<div id="footer" class="clearfix">
		<div class="inside">
			<?php print render($page['footer']); ?>
		</div>
	</div><!-- ID footer -->
	
</div><!-- ID page -->