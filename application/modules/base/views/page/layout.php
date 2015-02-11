<?php
/*
 * Description :
 * - This is the main layout. It will generate header, navigation, content, & footer
 */
?>

<!DOCTYPE html>
<html>

<!-- head -->
<?php $this->load->view('html/head'); ?>

<?php
	if(is_array($body_class)) {
		$_body_class = '';
		foreach ($body_class as $class) {
			$_body_class .= ' '.$class;
		}
	}else{
		$_body_class = $body_class;
	}
?>
<body class="dashboard-page sb-l-o sb-r-c<?php echo $_body_class ?>">
	
	<!-- Start: Theme Preview Pane -->
	<?php $this->load->view('html/skin-toolbox'); ?>
	<!-- End: Theme Preview Pane -->
	
	<!-- Start: Main -->
    <div id="main">

        <!-- Start: Header -->
		<?php $this->load->view('html/header'); ?>
        <!-- End: Header -->

        <!-- Start: Sidebar -->
		<?php $this->load->view('html/sidebar-left'); ?>
        <!-- End: Sidebar -->

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
			<?php $this->load->view('html/topbar'); ?>

			<!-- Start: Content -->
            <section id="content" class="animated fadeIn">
				
				<!-- global messages -->
				<?php echo $messages ?>
				
				<!-- the real content -->
				<?php $this->load->view($page_content); ?>
				
			</section>
			<!-- End: Content -->
		</section>
        <!-- End: Content-Wrapper -->

		<!-- Start: Right Sidebar -->
		<?php $this->load->view('html/sidebar-right'); ?>
		<!-- End: Right Sidebar -->

    </div>
    <!-- End: Main -->

</body>
</html>