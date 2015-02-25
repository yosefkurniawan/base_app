
<!-- jQuery -->
<script type="text/javascript" src="<?php echo skin_url('vendor/jquery/jquery-1.11.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('vendor/jquery/jquery_ui/jquery-ui.min.js') ?>"></script>

<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/bootstrap/bootstrap.min.js') ?>"></script>

<!-- Sparklines CDN -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/jquery.sparkline.min.js') ?>"></script>

<!-- Holder js  -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/bootstrap/holder.min.js') ?>"></script>

<!-- Theme Javascript -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/utility/utility.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/js/main.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/js/demo.js') ?>"></script>

<!-- Admin Panels  -->
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-plugins/admin-panels/json2.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-plugins/admin-panels/jquery.ui.touch-punch.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-plugins/admin-panels/adminpanels.js') ?>"></script>

<!-- Additional JS -->
<?php if (isset($js)): ?>
	<?php foreach ($js as $value): ?>
		<script type="text/javascript" src="<?php echo $value ?>"></script>
	<?php endforeach ?>
<?php endif ?>
