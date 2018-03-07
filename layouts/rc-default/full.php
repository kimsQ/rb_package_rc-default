<!DOCTYPE html>
<html lang="ko">
<head>
<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>
<!-- snap 서랍형 사이드메뉴 -->
<?php getImport('snap','rc-snap','1.9.3','css')?>
<?php getImport('snap','rc-snap','1.9.3','js')?>
</head>
<body class="rb-layout-full">

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

		<main role="main" class="content bg-faded" data-snap-ignore="true">
			<?php include __KIMS_CONTENT__ ?>
			<?php include $g['dir_layout'].'/_includes/footer.php' ?>
		</main>

		<?php include $g['dir_layout'].'/_includes/footer.php' ?>

	</div><!-- /.snap-content -->

	<?php include $g['dir_layout'].'/_includes/component.php' ?>
	<?php include $g['dir_layout'].'/_includes/component-bbs.php' ?>
	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>
	<script>
		$(function() {
			RC_initDrawer();
		});
	</script>
</body>
</html>
