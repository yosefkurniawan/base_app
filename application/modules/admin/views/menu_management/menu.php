<!-- begin: .tray-left -->
<aside class="tray tray-left tray320 va-t pn" data-tray-height="match" style="height: 2000px;">
<?php echo $this->load->view('menu_management/menu/menu_tree') ?>
</aside>
<!-- end: .tray-left -->

<!-- begin: .tray-center -->
<div class="tray tray-center p40 va-t posr">
    
    <?php echo $this->load->view('menu_management/menu/menu_editor') ?>

</div>
<!-- end: .tray-center -->  

<script type="text/javascript">
    (function($j){
        
        // instance helper
        globalhelper = new GlobalHelper();

        $j(document).ready(function() {
            
            /* ----------------------------------------- */
            /* Fancy Tree
            /* ----------------------------------------- */

            $("#menu-tree").fancytree({
                icons: false, // Display node icons.
                clickFolderMode: 2, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
                extensions: ["dnd", "edit"],
                edit: {
                    beforeEdit: false   // disable inline edit
                },
                dnd: {
                    autoExpandMS: 400,
                    focusOnClick: true,
                    preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
                    preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
                    dragStart: function(node, data) {
                        /** This function MUST be defined to enable dragging for the tree.
                         *  Return false to cancel dragging of node.
                         */
                        return true;
                    },
                    dragEnter: function(node, data) {
                        /** data.otherNode may be null for non-fancytree droppables.
                         *  Return false to disallow dropping on node. In this case
                         *  dragOver and dragLeave are not called.
                         *  Return 'over', 'before, or 'after' to force a hitMode.
                         *  Return ['before', 'after'] to restrict available hitModes.
                         *  Any other return value will calc the hitMode from the cursor position.
                         */
                        // Prevent dropping a parent below another parent (only sort
                        // nodes under the same parent)
                                  //  if(node.parent !== data.otherNode.parent){
                                  //   return false;
                                  // }
                                  // // Don't allow dropping *over* a node (would create a child)
                                  // return ["before", "after"];
                        
                        return true;
                    },
                    dragDrop: function(node, data) {
                        /** This function MUST be defined to enable dropping of items on
                         *  the tree.
                         */
                        data.otherNode.moveTo(node, data.hitMode);
                    },
                    dragStop: function(node,data){
                        // var neworder=new Array();
                        // var i=0;
                        // var all_drop_data = node.getParent();
                        // all_drop_data.visit(function(all_drop_data){
                        //     var parent = all_drop_data.parent.key;
                        //     if (parent.indexOf('root') > -1) {
                        //         parent = '0';
                        //     }
                            
                        //     neworder[i]=parent;

                        // console.log(all_drop_data.children);
                        //     if (all_drop_data.children) {
                        //         all_drop_data.children.visit(function(children){
                        //             neworder[i][j] = children.parent.key;
                        //         });
                        //     };
                        //     i++;
                        // });

                        // console.log(all_drop_data);
                        // console.log(neworder);


                        new_data = $j("#menu-tree").fancytree("getTree").toDict();
                        console.log(new_data);

                        depth = get_menu_depth(new_data);
                        console.log(depth);

                        if (depth > 3) {    // max depth to show on lef menu is 2
                            alert('Menu tidak dapat disimpan. Level menu melebihi batas maksimal.');
                            return false;
                        }else{
                            $j.ajax({
                                url:"<?php echo base_url().'admin/menu_management/menu/submit_order' ?>",
                                type:"POST",
                                data: {'data':new_data},
                                success:function(result){
                                }
                            });
                        }
                    }
                },
                activate: function(event, data) {
                    //        alert("activate " + data.node);
                }
            });
            

            /* ----------------------------------------- */
            /* Form menu Validation
            /* ----------------------------------------- */

            var form = $j( "#form-menu" );
            var validation_options = {
                
                    /* @validation states + elements 
                    ------------------------------------------- */
                    
                    errorClass: "state-error",
                    validClass: "state-success",
                    errorElement: "em",
                    
                    /* @validation rules 
                    ------------------------------------------ */
                        
                    rules: {
                            menu_name: {
                                    required: true
                            },            
                            portal_id: {
                                    required: true
                            },            
                            parent_id: {
                                    required: true
                            }
                    },

                    /* @validation error messages 
                    ---------------------------------------------- */
                        
                    messages:{
                                                                                            
                    },

                    /* @validation highlighting + error placement  
                    ---------------------------------------------------- */ 
                    
                    highlight: function(element, errorClass, validClass) {
                            $j(element).closest('.field').addClass(errorClass).removeClass(validClass);
                    },
                    unhighlight: function(element, errorClass, validClass) {
                            $j(element).closest('.field').removeClass(errorClass).addClass(validClass);
                    },
                    errorPlacement: function(error, element) {
                       if (element.is(":radio") || element.is(":checkbox")) {
                                element.closest('.option-group').after(error);
                       } else {
                                error.insertAfter(element.parent());
                       }
                    },
                    removehighlights: function(form) {
                        form.find('.field').removeClass(this.errorClass+' '+this.validClass);
                        form.find('em.'+this.errorClass).remove();
                    }
            }

            form.validate(validation_options); 
            
            /* ----------------------------------------- */
            /* Show active node in form
            /* ----------------------------------------- */

            $j("#menu-tree .ui-fancytree li").click(function(event){
                if(!$j(event.target).hasClass('btn-remove')){
                    setTimeout(function() 
                    {
                        var node = $("#menu-tree").fancytree("getActiveNode");
                        if( node ){
                            // get active menu data
                            $j.ajax({
                                url : "<?php echo base_url('admin/menu_management/menu/get_menu') ?>",
                                type: "GET",
                                data : {'menu_id':node.key},
                                dataType: 'json',
                                success:function(data, textStatus, jqXHR) 
                                {   
                                    $j('#form-menu-panel').show().addClass('animated fadeInRight');
                                    form = $j('#form-menu');
                                    form.find('.panel-heading .panel-title').text('Edit Menu');
                                    form.find('.alert').remove();
                                    form.find('#action').val('edit');
                                    form.find('#menu_id').val(data.menu_id);
                                    form.find('#menu_name').val(data.menu_name);
                                    form.find('#menu_desc').val(data.menu_desc);
                                    form.find('#parent_id').val(data.parent_id);
                                    form.find('#portal_id').val(data.portal_id);
                                    form.find('#menu_url').val(data.menu_url);
                                    if (data.menu_st=='active') {
                                        form.find('#menu_st').attr('checked','checked');
                                    }else{
                                        form.find('#menu_st').removeAttr('checked');
                                    }
                                    form.find('#menu_icon').val(data.menu_icon);
                                },
                                error: function(jqXHR, textStatus, errorThrown) 
                                {
                                    console.log('ajax error');
                                }
                            })
                        }
                    }, 100);
                }
            })

            /* ----------------------------------------- */
            /* Add akar button
            /* ----------------------------------------- */

            $j(".add-menu").click(function(){
                $j('#form-menu-panel').show().addClass('animated fadeInRight');
                $j('#menu-tree .fancytree-active').removeClass('fancytree-active');

                form = $j('#form-menu');
                form.find('.panel-heading .panel-title').text('Tambah Menu');
                form.find('.alert').remove();
                form.find('#action').val('create');
                form.find('#menu_name').val('');
                form.find('#menu_desc').val('');
                form.find('#parent_id').val('');
                form.find('#portal_id').val('');
                form.find('#menu_url').val('');
                form.find('#menu_st').attr('checked','');
                form.find('#menu_icon').val('');

                globalhelper.scrollTo(form.find('.panel-heading'));
            })

            /* ----------------------------------------- */
            /* Form Menu submit
            /* ----------------------------------------- */

            // $j("#form-menu").submit(function(e){
            //     if ($j(this).find('#action').val() == 'edit') {
            //         e.preventDefault();
            //         var form = $j(this);
            //         if (form.valid()) {
            //             var formURL = "<?php echo $submit_editor_url ?>";
            //             var postData = {};

            //             var data = {};
            //             $j.each(form.serializeArray(), function() {
            //                 data[this.name] = this.value;
            //             });

            //             postData.data = data;
            //             postData.action = data.action;

            //             $j.ajax({
            //                 url : formURL,
            //                 type: "POST",
            //                 data : postData,
            //                 dataType: 'json',
            //                 beforeSend: function() {
            //                     form.find(":input").attr("disabled", true);
            //                     form.find(".loading").css('visibility','visible');
            //                 },
            //                 success:function(data, textStatus, jqXHR) 
            //                 {
            //                     form.find('.panel-body > .alert').remove();
            //                     form.find('.panel-body').prepend(data.message);
            //                     form.validate().settings.removehighlights($j(form));
            //                     globalhelper.scrollTo($j('#form-menu .panel-heading '),500);
            //                 },
            //                 error: function(jqXHR, textStatus, errorThrown) 
            //                 {
            //                     globalhelper.ajax_error(textStatus);
            //                 },
            //                 complete: function() {
            //                     form.find(":input").attr("disabled", false);
            //                     form.find(".loading").css('visibility','hidden');
            //                 }
            //             });
            //         };
            //     }

            // })
    
            /* ----------------------------------------- */
            /* Show editor at first load if neccessary
            /* ----------------------------------------- */

            var showForm = "<?php echo $this->session->flashdata('show_form'); ?>";
            console.log(showForm);
            if (showForm) {
                $j('#form-menu-panel').show();
            };

        });
    
        /* ----------------------------------------- */
        /* Functions
        /* ----------------------------------------- */

        /* get menu tree depth */
        function get_menu_depth(data) {
            var max_depth = 1;
            
            data.forEach(function(value) {
                if (typeof value.children != 'undefined') {
                // if (isset($value['children'][0])) {
                    var depth = get_menu_depth(value.children) + 1;
                    if (depth > max_depth) {
                        max_depth = depth;
                    }
                }
            });

            return max_depth;
        }

    })(jQuery)
</script>