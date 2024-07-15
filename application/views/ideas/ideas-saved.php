<?php 
    if(isset($saved_ideas) && count($saved_ideas)>0){
        foreach($saved_ideas as $saved){
            
    ?>
    <span id="tab<?php echo $saved['idea_id']; ?>"></span>
    <div class="panel panel-default ideazone-content" id="allPosted_div_<?php echo $saved['idea_id']; ?>">
        <div class="panel-heading">
            <?php $primg = empty($saved['profile_picture'])? 'svg.svg': $saved['profile_picture']; ?>				
            <div class="row row-eq-height">
                <div class="col-lg-5">
                    <img src="<?php echo base_url(); ?>assets/images/uploads/<?php echo $primg; ?>" class="profile-pic" /> 
                    <span class="white"><?php echo $saved['name']; ?></span>
                </div>
                <div class="col-lg-3">
                    <span>&nbsp;</span>
                </div>
                <div class="col-lg-4">
                    <span class="pull-right">
                        <span class="stars allstars_<?php echo $saved['idea_id']; ?>" data-rating="<?php echo $saved['rating']; ?>" data-num-stars="5"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="industryimg hidden-xs hidden-sm">
                <?php 
                    $industry_pic = "assets/images/industries/67.jpg";
                    $filename = "assets/images/industries/".$saved['industry_id'].".jpg";
                    if(is_file($filename)){
                        $industry_pic = $filename;
                    }
                ?>
                <img src="<?php echo base_url().$industry_pic;?>" width="200" height="150"/> 
            </div>
            <div class="div2">
                <h6 class="h6class">Idea Title</h6>
                <p class="ideazonedescription"><?php echo $saved['idea_title']; ?></p>
                <h6 class="h6class">Industry</h6>
                <p class="ideazonedescription"><?php echo $saved['industry']; ?></p>
                <h6 class="h6class">Description</h6>
                <div id="short_desc_s<?php echo $saved['idea_id'];?>">
                    <p class="ideazonedescription">
                        <?php echo $saved['shortdescription'];?>
                    </p>&nbsp;
                    <button class="btn btn-primary" id="expand_content_s<?php echo $saved['idea_id'];?>">
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="long_desc_s<?php echo $saved['idea_id'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $saved['longdescription'];?>
                    </p>&nbsp;
                    <span><a id="seemore_s<?php echo $saved['idea_id'];?>" class="btn btn-xs btn-info">See More</a></span>
                </div>
                <div id="full_desc_s<?php echo $saved['idea_id'];?>" style="display:none;">
                    <p class="ideazonedescription">
                        <?php echo $saved['description'];?>
                    </p>&nbsp;
                    <!--span><a id="seeless_s<?php echo $saved['idea_id'];?>" class="btn btn-xs btn-info">See Less</a></span-->
                </div>
                <input type="hidden" id="ideacontent" value="0">
                <div id="resource_details_s<?php echo $saved['idea_id'];?>">
                    
                </div>
            </div>
        </div> 
        <?php if(!empty($saved['tag_name'])){ ?>
        <div class="panel-footer" style="background-color:#f9f9f9;padding:5px 15px; ">
            <p class="ideatags">
              <?php 
                $tags = explode(',', $saved['tag_name']);
                $slug = explode(',', $saved['slug']);
                foreach ($tags as $k=>$tag){?>
                    <a href="/tag/<?php echo $slug[$k];?>"><?php echo $tag." ";?></a>
                <?php } ?>
            </p>
        </div>
        <?php } ?>
        
    </div>
        <?php } ?>
        <?php }else{ ?>
    <div class="panel panel-default ideazone-content" id="allPosted_div_0">
        <div class="panel-heading">&nbsp;</div>
        <div class="panel-body">No ideas Posted</div>
        <div class="panel-footer">&nbsp;</div>
    </div>
<?php } ?>