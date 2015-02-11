

    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage Permission</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li class="active">Manage Permission</li>
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
          <h3 class="panel-title">Manage Permission</h3>
          <p>
        Don't Touch this data unless you're confident. 
          </p>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table" id="table1">
		                            <thead>
		                                <tr>
						                <th style="width:10%;">#</th>
						                <th style="width:20%;">Name</th>
						                <th style="width:40%;">Description</th>
						                <th style="width:20%;">Status</th>
						                <th style="width:10%;"></th>
		                                </tr>
		                            </thead>

		                            <tbody>
		                                <?php $no = 1; foreach ($rs_role as $result): ?>
		                                    <tr>
		                                        <td><?php echo $no; ?></td>
		                                        <td><?php echo $result['role_name']; ?></td>
		                                        <td><?php echo word_limiter($result['role_desc'], 20); ?></td>
		                                        <td><?php echo $result['role_st']; ?></td>
		                                        <td>
                                               <a href="<?php echo base_url(); ?>setting/permission/edit/<?php echo $result['role_id']; ?>">
                                                <i class="fa fa-pencil"></i></a>
		                                        </td>
		                                    </tr>
		                                <?php $no++; endforeach ; ?>
		                            </tbody>


           </table>
          </div><!-- table-responsive -->
          <div class="clearfix mb30"></div>
        </div><!-- panel-body -->
      </div><!-- panel -->
        
    </div><!-- contentpanel -->