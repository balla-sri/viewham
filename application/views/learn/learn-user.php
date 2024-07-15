<section class="ideazone">
    <div class="container">
        <div class="row mb-10 hidden-sm hidden-xs">
            <div class="col-md-5">
                <!--space for breadcrumbs--->
            </div>
            <div class="col-md-3 col-xs-6">
                <ul class="switch-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#explore" aria-controls="explore" role="tab" data-toggle="tab">Explore</a>
                    </li>
                    <li role="presentation">
                        <a href="#myFeed" aria-controls="myFeed" role="tab" data-toggle="tab">My Feed</a>
                    </li>
                
                </ul>
            </div>
            <!--div class="col-md-4 col-xs-6 text-right search-skill">
                <ul class="nav nav-pills notify-nav" role="tablist">
                    <li role="presentation" class="dropdown">
                        <form id="demo-2">
                            <input type="search" placeholder="Search" class="cont-search">
                        </form>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a href="#" class="dropdown-toggle filter" id="n2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-filter"></i>
                        </a>
                        <ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n2">
                            <li>
                                <a href="#">All</a>
                            </li>
                            <li>
                                <a href="#">Post</a>
                            </li>
                            <li>
                                <a href="#">Q & A</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div-->
        </div>
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view('common/common-left-menu.php');?>   
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- start of Add Post -->
                                    <div class="bootstrap snippet">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="well well-sm well-social-post">

                                                    <div id="site_content">


                                                    </div>
                                                    <form name="comment_form" id="comment_form" method="POST" action="/learn/new_post" enctype="multipart/form-data" >
                                                    <input type="hidden" name="session_exist" id="session_exist" value="<?php echo $session_exist;?>">
                                                    <input type="hidden" name="profile_id" id="profile_id" value="<?php echo $profile_id; ?>">
                                                    <input type="hidden" name="feed_type" id="feed_type" value="1"/>
                                                    <ul class="list-inline" id='list_PostActions'>
                                                        <li id="feed_post">
                                                            <a href='#'>Post</a>
                                                        </li>
                                                        <li class='active' id="feed_question">
                                                            <a href='#'>Q&A</a>
                                                        </li>
                                                    </ul>
                                                    <div class="row" id="post_content">
                                                        <div class="col-sm-1 col-xs-2">
                                                            <img src="<?php echo base_url() ?>assets/images/svg.svg" class="user-pic">
                                                        </div>
<div class="col-sm-9 col-xs-10">
<div class="tag-container">




<select id="multi" data-attr="skills" name="multi[]" multiple class="" style="width: 100%;margin-bottom: 10px !important;" placeholder="Tag a Skill">

    <option value="">Select a Role...</option>
    <?php foreach($skills as $p){ ?>
        <option value="<?php echo $p['id']; ?>">
            <?php echo $p['skill']; ?>
        </option>
        <?php } ?>

</select>
<script>
    $('#multi').selectize({
        maxItems: 5
    });
</script>
<!--div class="chip blue lighten-2">
<img src="https://bootdey.com/img/Content/user_1.jpg" alt="Contact Person"> John Doe
<i class="close fa fa-times"></i>
</div>
<div class="chip amber lighten-3">
<img src="<?php echo base_url() ?>assets/images/user-pic.jpg" alt="Contact Person"> Danny Moore
<i class="close fa fa-times"></i>
</div>
<div class="chip purple lighten-4">
<img src="https://bootdey.com/img/Content/user_1.jpg" alt="Contact Person"> Adam Grey
<i class="close fa fa-times"></i>
</div-->
</div>
<textarea id="question" name="question" class="form-control" placeholder="Ask your Question..." required></textarea>
</div>
<div class="col-sm-2 col-xs-12 text-right dropdown">

</div>
<div class="col-sm-9 col-xs-10">
<!--<button class="btn btn-info tag-btn mTag-btn dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-tags"></i> Tag</button>-->
<!--<ul class="dropdown-menu" id="tag-user">
<li>
<div class="search-box-container">
<input type="text" id="search-input" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
</div>
</li>
<li><a href="#">Ajay</a></li>
<li><a href="#">Krishna</a></li>
<li><a href="#">Prasad</a></li>
</ul>-->							


<link href="<?php echo base_url(); ?>assets/css/picker.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/js/picker.js"></script>
<script>
$(document).ready(function(){
var classes = {
0 : 'chip amber lighten-3',
1 : 'chip blue lighten-2',
2 : 'chip purple lighten-4',
3 : 'chip amber lighten-3'
};
$('#multi').picker({search : true,triggertext: "Select value tags", coloring: classes,containerClass:'col-sm-9 col-xs-10'});
$('.pc-element .pc-trigger').val('gd')
});


</script>





                                                          
												</div>
                                                    </div>
                                                    <ul class="list-inline post-actions">
                                                        <li>


                                                            <label class="file-upload btn btn-info tag-btn">Attachment
                                                                <?php echo "<input type='file' name='userfile[]' multiple=multiple accept='.pdf,.doc,.docx,.png,.bmp,.jpg,.jpeg' />"; ?>
                                                            </label>
                                                        </li>
                                                        <li class='pull-right'>
                                                            <input  id="post_submit" class="btn btn-primary post-btn" type="submit" name="add" value="Post" />
                                                            <!--<button href="#" class='btn btn-primary post-btn'>Postsss</a>-->
                                                        </li>
                                                    </ul>

                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of Add Post -->
                                    <div id="explore">

                                    </div>
                                    <div id="myFeed">

                                    </div>
                                </div>
                                <?php $this->view('learn/right-bar') ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php $this->load->view('modals/signup_modal');?>
<?php $this->load->view('modals/signin_modal');?>
<!-- jQuery -->
<script>
    $('document').ready(function () {
        var profileid = $('#profile_id').val();
        if ($(".switch-tab li").hasClass('active')) {

            $.ajax({
                url: '<?php echo base_url(); ?>learn/explore',
                type: 'post',
                data: {profileid: profileid},
                dataType:'json',
                success: function (response) {
                    $('#explore').html(response.view);
                    if( $(this).attr('id') =='feed_post'){
                        $('.questionclass').hide();
                        $('.postclass').show();
                    }else{
                        $('.questionclass').show();
                        $('.postclass').hide();
                    }
                }

            });


        }
//$('.file-upload').file_upload();
    });

    $(".switch-tab li a").click(function () {
        if ($(this).attr('href') == '#explore') {
            $.ajax({
                url: '<?php echo base_url(); ?>learn/explore',
                type: 'post',
                //data: {postid: postid, type: type},
                success: function (response) {
					$('#explore').show();
                    $('#explore').html(response.view);
					$('#myFeed').hide();
                }

            });
        } else {
            var sess = $('#session_exist').val();
            if(sess == 0){
                $('#signinModal').modal('toggle');
            }else{
                $.ajax({
                    url: '<?php echo base_url(); ?>learn/feed_posts',
                    type: 'post',
                    //data: {postid: postid, type: type},
                    success: function (response) {
    					$('#myFeed').show();
                        $('#myFeed').html(response);
    					$('#explore').hide();
                        if( $(this).attr('id') =='feed_post'){
                            $('.questionclass').hide();
                            $('.postclass').show();
                        }else{
                            $('.questionclass').show();
                            $('.postclass').hide();
                        }
                    }

                });
            }
        }
    });
    
    function checkSession(){
        var sess = $('#session_exist').val();
        if(sess == 0){
            $('#signinModal').modal('toggle');
        }else{
            var question = $('#question').val();
            var tags = $('#multi').val();
            if(tags==''){
                alert('Please tag atleast one skill');
            }else if(question==""){
                if($('#feed_type').val()==1){
                    alert('Please enter your Question');    
                }else{
                    alert('Please write your views');
                }
                
            } else{
                document.getElementById("comment_form").submit();    
            }
            
        }
    }

    $('#post_submit').click(function(e){
        e.preventDefault();
        checkSession();
    });
 
 
</script>


<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
