<div id="modal-permission-form" class="popup-basic popup-lg admin-form mfp-with-anim mfp-hide">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-key"></i>Edit Permission (Role: <span class="role-name"></span> )</span>
        </div>
        
        <form method="post" action="/" id="permission-form">
            <input type="hidden" name="role_id" id="role_id" value=""/>
            <div class="row">
                <div class="col-md-12">
                    <div class="" id="spy4">
                        <div class="panel-body p20">
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="table-permission" width="100%">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th class="text-center">Create (C)</th>
                                        <th class="text-center">Read (R)</th>
                                        <th class="text-center">Update (U)</th>
                                        <th class="text-center">Delete (D)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td colspan="5">
                                            <p class="loading text-center"><i class="fa fa-spinner spinner"></i>&nbsp;Loading...</p>
                                        </td>
                                    </tr> -->
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>        
            </div>

            <div class="panel-footer p20">
                <button type="submit" class="button btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>