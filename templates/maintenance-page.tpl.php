<?php
// $Id:

/**
 * @file
 * Implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in page.tpl.php.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 * @see layoutstudio_process_maintenance_page()
 */
?> <!DOCTYPE html>
 <html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?> class="no-js">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
	
	<div id="page">

		<header id="header" class="region clearfix">

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

		</header><!-- ID header -->

		<div id="container" class="clearfix">
							
			<div id="content" class="clearfix">
				
				<div id="wrapper">
					<div id="primary">
			      <div class="inside" class="clearfix">
	
							<a id="content-area"></a>

				      <?php if ($messages): ?>
				      	<section id="help" class="region help-region clearfix">
					      	<?php print $messages; ?>
					      </section><!-- ID help -->
					    <?php endif; ?>

				      <?php if ($title): ?>
				        <h1 class="title" id="page-title">
				          <?php print $title; ?>
				        </h1>
				      <?php endif; ?>
	
				      <?php print $content; ?>
		
			      </div><!-- CLASS inside -->
					</div><!-- ID primary -->
				</div><!-- ID wrapper -->
					
			</div><!-- ID content -->
			
		</div><!-- ID container -->
			
	</div><!-- ID page -->

</body>
</html>
