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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
	
	<div id="page">

		<div id="header" class="region clearfix">

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

		</div><!-- ID header -->

		<div id="container" class="clearfix">
							
			<div id="content" class="clearfix">
				
				<div id="wrapper">
					<div id="primary">
			      <div class="inside" class="clearfix">
	
							<a id="content-area"></a>

							<?php print render($page['help']); ?>
					   	<?php print $messages; ?>

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
