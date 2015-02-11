    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage Menu </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li><a href="<?php echo base_url();?>setting/menu">Manage Menu</a></li>
          <li class="active">Manage Menu : <?= $portal['portal_name']; ?></li>
        </ol>
      </div>
    </div>
        
    <div class="contentpanel">
      
      <?php if ($message != null ) : ?>
      <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Well done!</strong>   <?php echo $message; ?>
        </div>
      <?php endif ; ?>


      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Manage Menu : <?= $portal['portal_name']; ?></h3>
          <p>
		        Don't Touch this data unless you're confident. <br><br>
	            <a href="<?php echo base_url(); ?>setting/menu/add/<?php echo $portal['portal_slug']; ?>" data-title="Add Data" class="tip"><i class="fa fa-plus"></i> Add new menu</a>
          </p>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table" id="table1">
		                            <thead>
		                                <tr>
		                                    <th>#</th>
		                                    <th>Name</th>
		                                    <th>Description</th>
		                                    <th>Order</th>
		                                    <th style="width:12%;"></th>
		                                </tr>
		                            </thead>
		                            <tbody>
                                        <?php $no = 1; foreach ($rs_menu as $key) : ?>
                                        	<tr>
                                        		<td><?php echo $no; ?></td>
                                        		<td><?php echo "- " . $key['menu_name']; ?></td>
                                        		<td><?php echo $key['menu_desc']; ?></td>
                                        		<td><?php echo $key['menu_order']; ?></td>
                                        		<td>
                                               <a href="<?php echo base_url(); ?>setting/menu/edit/<?php echo $portal['portal_slug']; ?>/<?php echo $key['menu_slug']; ?>">
                                                <i class="fa fa-pencil"></i></a>
                                                &nbsp;&nbsp;
                                               <a href="<?php echo base_url(); ?>setting/menu/delete/<?php echo $portal['portal_slug']; ?>/<?php echo $key['menu_slug']; ?>">
                                                <i class="fa fa-trash-o"></i></a>
                                        		</td>
                                        	</tr>
                                            <?php if (!empty($key['detail'])) : ?>
                                                <?php foreach ($key['detail'] as $value) : $no++; ?>
		                                        	<tr>
		                                        		<td><?php echo $no; ?></td>
		                                        		<td><?php echo "-- " . $value['menu_name']; ?></td>
		                                        		<td><?php echo $value['menu_desc']; ?></td>
		                                        		<td><?php echo $value['menu_order']; ?></td>
		                                        		<td>
                                               <a href="<?php echo base_url(); ?>setting/menu/edit/<?php echo $portal['portal_slug']; ?>/<?php echo $value['menu_slug']; ?>">
                                                <i class="fa fa-pencil"></i></a>
                                                &nbsp;&nbsp;
                                               <a href="<?php echo base_url(); ?>setting/menu/delete/<?php echo $portal['portal_slug']; ?>/<?php echo $value['menu_slug']; ?>">
                                                <i class="fa fa-trash-o"></i></a>
		                                        		</td>
		                                        	</tr>
                                                <?php endforeach ; ?>
                                            <?php endif ; ?>
                                        <?php $no++; endforeach ; ?>
		                            </tbody>
           </table>
          </div><!-- table-responsive -->
          <div class="clearfix mb30"></div>
        </div><!-- panel-body -->
      </div><!-- panel -->
        
    </div><!-- contentpanel -->
    
<script src="<?php echo base_url();?>bracket/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/modernizr.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/toggles.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/retina.min.js"></script>
<script src="<?php echo base_url();?>bracket/js/jquery.cookies.js"></script>

<script src="<?php echo base_url()?>bracket/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url()?>bracket/js/chosen.jquery.min.js"></script>

<script src="<?php echo base_url();?>bracket/js/custom.js"></script>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
  
  });
</script>
