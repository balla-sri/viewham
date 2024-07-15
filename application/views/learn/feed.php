    
<section class="ideazone">
    <div class="container">
        <div class="row mb-10 hidden-sm hidden-xs">
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
            <div class="col-md-4 col-xs-6 text-right search-skill">
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
            </div>
        </div>
        <div class="row">
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
                                                    <?php //echo form_open_multipart('Learn/new_post'); ?>
                                                    <?php //echo form_open_multipart('controller', array('id' => 'comment_form')); ?>
                                                    <form name="" id="comment_form" method="POST" action="" enctype="multipart/form-data" >
                                                    <ul class="list-inline" id='list_PostActions'>
                                                        <li>
                                                            <a href='#'>Post</a>
                                                        </li>
                                                        <li class='active'>
                                                            <a href='#'>Q&A</a>
                                                        </li>
                                                    </ul>
                                                    <div class="row" id="post_content">
                                                        <div class="col-sm-1 col-xs-2">
                                                            <img src="<?php echo base_url() ?>assets/images/user-pic.jpg" class="user-pic">
                                                        </div>
                                                        <div class="col-sm-9 col-xs-10">
                                                            <!--div class="tag-container">


                                                                <select name="multi[]" id="multi" multiple class="btn btn-info tag-btn mTag-btn dropdown-toggle">
                                                                    <option value="" disabled hidden>Tag</option>
                                                                    <option value="1">Ajay</option>
                                                                    <option value="2">Krishna</option>
                                                                    <option value="3">Prasad</option>

                                                                </select>

                                                            </div-->
                                                            <textarea id="question" name="question" class="form-control" placeholder="Ask your Question..." required></textarea>
                                                        </div>
                                                        <div class="col-sm-2 col-xs-12 text-right dropdown">

                                                        </div>
                                                        <div class="col-sm-9 col-xs-10">
                                                            <!--<link href="<?php echo base_url(); ?>assets/css/picker.css" rel="stylesheet" type="text/css">
                                                            <script src="<?php echo base_url(); ?>assets/js/picker.js"></script>-->
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
                                                                <?php echo "<input type='file' name='userfile[]' multiple=multiple/>"; ?>
                                                            </label>
                                                        </li>
                                                        <li class='pull-right'>
                                                            <input class="btn btn-primary post-btn" type="submit" name="add" value="Post" />
                                                            <!--<button href="#" class='btn btn-primary post-btn'>Postsss</a>-->
                                                        </li>
                                                    </ul>
                                                    </form>
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
                                
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- jQuery -->
<script>
    $('document').ready(function () {
        if ($(".switch-tab li").hasClass('active')) {
            $.ajax({
                url: '<?php echo base_url(); ?>learn/explore',
                type: 'post',
                //data: {postid: postid, type: type},
                success: function (response) {
                    $('#explore').html(response);
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
                    $('#explore').html(response);
                    $('#myFeed').hide();
                }

            });
        } else {
            $.ajax({
                url: '<?php echo base_url(); ?>learn/feed_posts',
                type: 'post',
                success: function (response) {
                    $('#myFeed').show();
                    $('#myFeed').html(response);
                    $('#explore').hide();
                }

            });
        }
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>