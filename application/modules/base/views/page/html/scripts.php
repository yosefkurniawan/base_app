
<!-- jQuery -->
<script type="text/javascript" src="<?php echo skin_url('vendor/jquery/jquery-1.11.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('vendor/jquery/jquery_ui/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('vendor/jquery/jquery.class.js') ?>"></script>

<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/bootstrap/bootstrap.min.js') ?>"></script>

<!-- Sparklines CDN -->
<script type="text/javascript" src="<?php echo skin_url('vendor/jquery/jquery.sparkline.min.js') ?>"></script>

<!-- Holder js  -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/bootstrap/holder.min.js') ?>"></script>

<!-- Vendor JS  -->
<script type="text/javascript" src="<?php echo skin_url('vendor/plugins/magnific/jquery.magnific-popup.js') ?>"></script>

<!-- Admin Forms Javascript -->
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-forms/js/jquery-ui-monthpicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-forms/js/jquery-ui-timepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-forms/js/jquery-ui-touch-punch.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-forms/js/jquery.spectrum.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-forms/js/jquery.stepper.min.js') ?>"></script>

<!-- Admin Panels  -->
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-plugins/admin-panels/json2.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-plugins/admin-panels/jquery.ui.touch-punch.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/admin-tools/admin-plugins/admin-panels/adminpanels.js') ?>"></script>

<!-- Theme Javascript -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/utility/utility.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/js/main.js') ?>"></script>
<script type="text/javascript" src="<?php echo skin_url('assets/js/demo.js') ?>"></script>

<!-- Helper -->
<script type="text/javascript" src="<?php echo skin_url('assets/js/helpers/global.js') ?>"></script>

<!-- Additional JS -->
<?php if (isset($js)): ?>
	<?php foreach ($js as $value): ?>
		<script type="text/javascript" src="<?php echo $value ?>"></script>
	<?php endforeach ?>
<?php endif ?>

<script type="text/javascript">
    jQuery(document).ready(function() {

        "use strict";

        // Init Theme Core    
        Core.init();

        // Init Demo JS     
        Demo.init();

    });
</script>