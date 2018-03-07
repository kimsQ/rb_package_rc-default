<!DOCTYPE html>
<html lang="ko">
<head>
<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>
<!-- snap 서랍형 사이드메뉴 -->
<?php getImport('snap','rc-snap','1.9.3','css')?>
<?php getImport('snap','rc-snap','1.9.3','js')?>


</head>
<body class="rb-layout-default">

	<div class="snap-drawers">
		<div class="snap-drawer snap-drawer-left" id="drawer-left">
			<?php include $g['dir_layout'].'/_includes/drawer-left.php' ?>
		</div>
		<div class="snap-drawer snap-drawer-right bg-faded" id="drawer-right">
			<?php include $g['dir_layout'].'/_includes/drawer-right.php' ?>
		</div>
	</div>

	<div class="snap-content" data-extension="drawer">

		<?php include $g['dir_layout'].'/_includes/header.php' ?>

		<div class="bar bar-standard bar-header-secondary bar-light bg-white animated fadeIn delay-1" data-snap-ignore="true">
		 <h1 class="title"><?php echo $_HM['name']?></h1>
		</div>

		<main role="main" class="content" data-snap-ignore="true">

			<article class="content-padded animated fadeIn delay-1 markdown-body" style="min-height:300px" role="article">
				<?php include __KIMS_CONTENT__ ?>
			</article>
			<?php include $g['dir_layout'].'/_includes/footer.php' ?>
		</main>

		<?php include $g['dir_layout'].'/_includes/footer.php' ?>
	</div><!-- /.snap-content -->

	<?php include $g['dir_layout'].'/_includes/component.php' ?>

	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>

	<script>
		$(function() {
			RC_initDrawer();
			$('.mejs-player').mediaelementplayer(); // http://www.mediaelementjs.com/
		});

		$(window).load(function() {
	    $('[role="article"] img').captionjs({
        'class_name'      : 'captionjs captionjs-default img-fluid', // Class name for each <figure>
        'schema'          : true,        // Use schema.org markup (i.e., itemtype, itemprop)
        'debug_mode'      : false,       // Output debug info to the JS console
        'force_dimensions': true,        // Force the dimensions in case they cannot be detected (e.g., image is not yet painted to viewport)
        'is_responsive'   : false,       // Ensure the figure and image change size when in responsive layout. Requires a container to control responsiveness!
        'inherit_styles'  : false        // Have the caption.js container inherit box-model properties from the original image
	    });
		});

	</script>

</body>
</html>
