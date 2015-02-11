    <div class="pageheader">
      <h2><i class="fa fa-group"></i> Manage Menu </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>dashboard">Pinaple SAS</a></li>
          <li class="active">Manage Menu</li>
        </ol>
      </div>
    </div>
        
    <div class="contentpanel">
      


      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Manage Menu</h3>
          <p>
        Don't Touch this data unless you're confident. 
          </p>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table" id="table1">
              <thead>
                <th style="width:10%;">#</th>
                <th style="width:20%;">Name</th>
                <th style="width:25%;">Title</th>
                <th style="width:25%;">Description</th>
                <th style="width:20%;"></th>
              </thead>
              <tbody>
                                    <?php $no = 1; foreach ($rs_portal as $result): ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $result['portal_name']; ?></td>
                                            <td><?php echo $result['portal_title']; ?></td>
                                            <td><?php echo word_limiter($result['portal_desc'], 20); ?></td>
                                            <td>
                                               <a href="<?php echo base_url(); ?>setting/menu/list_menu/<?php echo $result['portal_slug']; ?>">
                                               Manage Menu</a>
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
