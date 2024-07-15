<a href="javascript:void()" class="filter-btn visible-xs visible-sm"><img src="<?php echo base_url(); ?>assets/images/filter.png" alt="filter"/></a>
    <div class="panel panel-default filter-content searchblock">
        <div class="panel-heading">Filters</div>
        <div class="panel-body">
            <form action="" method="post" name="idea_filter" id="idea_filter">
                <label>Industry</label>
                <select name="industrkey[]" id="e2_2" class="e2_2aaa mb-5" style="width:100%" tabindex="-1">
                <?php
                    foreach($listindustries as $ind){ ?>
                        <option  value="<?php echo $ind['slug']; ?>" 
                            <?php if(!empty($industrkey)){
                                    if (in_array($ind['slug'], $industrkey)){  
                                        echo "selected";  
                                    }
                                }   ?>
                            ><?php echo $ind['industry']; ?></option>
                    <?php } ?>
                </select>
                <script>
                    $(document).ready(function() { 
                        $(".e2_2aaa").select2({
                            placeholder: "Search by Industry"
                        });
                    });
                </script>
                <p class="mt-20">
                    <a href="<?php echo base_url('businessideas'); ?>" class="btn btn-info mb-0 mr-10">Clear</a>
                    <button class="btn btn-primary mb-0" id="apply_filter">Apply</button>
                </p>
            </form> 
       </div>
    </div>
    <script type="text/javascript">
        $('#apply_filter').click(function(event){
            event.preventDefault();
            var base_url = window.location.origin;
            var industyname = $('#e2_2').val();
            var url = base_url+'/businessideas/'+industyname;
            $(location).attr('href',url);
        });
    </script>