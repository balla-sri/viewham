
<script type= 'text/javascript' src="<?php echo base_url(); ?>blog_assets/js/jquery-ui-1.10.3-custom.min.js"></script>
<script type= 'text/javascript' src="<?php echo base_url(); ?>blog_assets/js/jquery-migrate-1.2.1.js"></script>
<script type= 'text/javascript' src="<?php echo base_url(); ?>blog_assets/js/jquery.blockUI.js"></script>
<script type= 'text/javascript' src="<?php echo base_url(); ?>blog_assets/js/share.js"></script>
<script type= 'text/javascript' src="<?php echo base_url(); ?>blog_assets/js/like.js"></script>
<!-- start of dynamic Posts -->
<?php foreach ($posts as $posts_item): ?>
<?php $postclass = ($posts_item['type'] == 1)? "questionclass":"postclass";?>
<div class="row bootstrap snippet <?php echo $postclass;?>">
	<div class="col-sm-12">
		<div class="panel panel-white post panel-shadow">
			<i class="fa fa-bookmark enable"></i>
			<div class="post-heading">
				<div class="pull-left image">
					<img src="<?php echo base_url('assets/images/svg.svg'); ?>" class="img-circle avatar" alt="user profile image">
				</div>
				<div class="pull-left meta">
					<h5 class="post-title">
						<a href="#"><?php echo $posts_item['username']; ?></a>
					</h5>
					<h6 class="text-muted"><?php echo $posts_item['created_date']; ?>
					<!--Just now - Hyderabad-->
					</h6>
				</div>
				<div class="pull-right">
					<button class="btn btn-info tag-btn blue-tag">
						<?php echo ($posts_item['type']==1) ? "Question":"Post";?>
					</button>
					<!--div role="presentation" class="dropdown">
						<a href="#" class="dropdown-toggle dots" id="n2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span>...</span>
						</a>
						<ul class="dropdown-menu animation slideDownIn" id="menu1" aria-labelledby="n2">
						<li>
						<a href="#">View</a>
						</li>
						<li>
						<a href="#">Reply</a>
						</li>
						<li>
						<a href="#">Delete</a>
						</li>
						</ul>
					</div-->
				</div>
			</div>
			<div class="post-description">
				<p><?php echo $posts_item['question']; ?></p>
				<div>
					<?php
						if (!empty($posts_item['tags'])) {
							$tags = explode(",", $posts_item['tags']);
							foreach ($tags as $tag) {
					?>
								<button class="btn btn-info tag-btn blue-tag">
									<i class="fa fa-tags"></i> 
									<?php $t = getTagInfo($tag); ?>
									<?php echo $t; ?>
								</button>
					<?php
							}
						}
					?>
				</div>
				<?php
					if (!empty($attachments)) {
						foreach ($attachments as $attachment) {
							for ($i = 0; $i < count($attachment); $i++) {
								if ($attachment[$i]['post_id'] == $posts_item['post_id']) {
									$attachment_img = $attachment[$i]['name'];
									if (file_exists('uploads/' . $attachment_img) && !empty($attachment_img)) { ?>					
										<img src="<?php echo base_url() . 'uploads/' . $attachment_img; ?>" class="mt-20 img-responsive img-rounded" />
									<?php } ?>

								<?php } else {
									$attachment_img = '';
								}
							}
						}
					}
				?>
			</div>
			<div class="post-footer">
				<a href="javascript:void(0);" class="stat-item like" id="like_<?php echo $posts_item['post_id']; ?>" style="<?php
					if ($posts_item['type'] == 1) {
						echo "color: #4080ff;";
					} else {
						echo "color:#616770;";
					}
				?>"><i class="glyphicon glyphicon-thumbs-up"></i> Vote Up</a>

				<a href="javascript:void(0);" class="stat-item" onclick="showanswer(<?php echo $posts_item['post_id']; ?>);" id="ans_<?php echo $posts_item['post_id']; ?>" data-toggle="collapse" data-target="#myfeed_ans_toggle_<?php echo $posts_item['post_id']; ?>">
				<i class="glyphicon glyphicon-comment"></i> Answer</a>

				<div style="float:right"class='share-button'></div>

				<script>
				/*$(function(){
					$('.share-button').share({
						title: 'Share Button Test',
						image: 'http://carrot.is/img/fb-share.jpg',
						app_id: '602752456409826',
						background: 'rgba(255,255,255,.5)',
						color: '#616770'
					})
				});*/
				</script>
			</div>
			<div class="post-footer">
				<?php if($posts_item['cnt'] > 0){?>
				<a href="#" class="like">
					<i class="fa fa-thumbs-up"></i> <?php echo $posts_item['cnt'];?>  Person(s) liked
				</a>
				<?php } ?>
			</div>
			<!--start of answers with replies-->
			<div class='singlepost post-content'>
				<div class='fullpost clearfix' post-container>
					<div class='entry post-detail'>
						<div style="width:100%;display:none;" id="showanswer_<?php echo $posts_item['post_id']; ?>">
							<div id="comment_wrapper_<?php echo $posts_item['post_id']; ?>" class="comment_wrapper">
								<div class="comment_form_wrapper" id="comment_form_wrapper_<?php echo $posts_item['post_id']; ?>">
									<div id="comment_resp"></div>
									<h4><a href="javascript:void(0);" onclick="cancel_comment(<?php echo $posts_item['post_id']; ?>)" class= "cancel-comment-reply-link" id="cancel-comment-reply-link_<?php echo $posts_item['post_id']; ?>">Cancel Reply</a></h4>
									<form class="comment_form" id="comment_form_<?php echo $posts_item['post_id']; ?>" name="comment_form" action="" method="post">
										<div class="post-comment">
    
											<input type="text" name="comment_text" id="comment_text_<?php echo $posts_item['post_id']; ?>" class="form-control" placeholder="Post a comment">
										</div>
										<div>
											<input  type="hidden" name="post_id" id="post_id" value="<?php echo $posts_item['post_id']; ?>" />

											<input type="hidden" name="reply_id" id="reply_id_<?php echo $posts_item['post_id']; ?>" value=""/>
											<input type="button" name="comment_submit" onclick="post_comment('<?php echo $posts_item['post_id']; ?>');" id="comment_submit_<?php echo $posts_item['post_id']; ?>" value="Post Comment" class="btn btn-primary post-btn"/>
										<!--button comment_submit-->
										</div>
									</form>
								</div>
								<?php
									if (!empty($answers)) {
										foreach ($answers as $key =>$answer) {
											if ($key == $posts_item['post_id']) {
												echo $answer;
												break;
											} else {
												$answer = '';
											}
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- end of answers with replies -->
	</div>
</div>
<?php endforeach; ?>
<!-- end of dynamic Posts -->
<script type="text/javascript">
	function showanswer(post_id){
		var sess = $('#session_exist').val();
        if(sess == 0){
            $('#signinModal').modal('toggle');
        }else{
			$("#comment_form_wrapper_"+post_id).show();
			$('#showanswer_'+post_id).show();
		}
	}

	function post_comment(post_id){
		if ($("#comment_text_"+post_id).val() == "")
		{
			alert("Please enter your comment");
			return false;
		}
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>learn/new_answer",
			data: $('#comment_form_'+post_id).serialize(),
			dataType: "html",
			beforeSend: function () {
				$('#comment_wrapper_'+post_id).block({
					message: 'Please wait....',
					css: {
						border: 'none',
						padding: '15px',
						backgroundColor: '#ccc',
						'-webkit-border-radius': '10px',
						'-moz-border-radius': '10px'
					},
					overlayCSS: {
						backgroundColor: '#ffe'
					}
				});
			},
			success: function (comment) {
				var reply_id = $("#reply_id_"+post_id).val();
				if (reply_id == "") {
					$("#comment_wrapper_"+post_id+" ul:first").prepend(comment);
					if (comment.toLowerCase().indexOf("error") >= 0) {
						$("#comment_resp_err").attr("value", comment);
					}
				} else {
					if ($("#li_comment_" + reply_id).find('ul').size() > 0) {
						$("#li_comment_" + reply_id + " ul:first").prepend(comment);
					} else {
						$("#li_comment_" + reply_id).append('<ul class="comment">' + comment + '</ul>');
					}
				}
				$("#comment_text_"+post_id).attr("value", "");
				$("#reply_id_"+post_id).attr("value", "");
				$("#cancel-comment-reply-link_"+post_id).hide();
				$("#comment_wrapper_"+post_id).prepend($("#comment_form_wrapper_"+post_id));
				$('#comment_wrapper_'+post_id).unblock();
				$('#showanswer_'+post_id).show();
			}
		});
	}
	function cancel_comment(post_id){
		$("#reply_id_"+post_id).attr("value", "");
		$("#comment_wrapper_"+post_id).prepend($("#comment_form_wrapper_"+post_id));
		$("#comment_form_wrapper_"+post_id).hide();
		$('#showanswer_'+post_id).hide();
	}

	$(function () {
		var post_id= $('#post_id').val();
		$("#cancel-comment-reply-link_"+post_id).hide();
		$(".reply_button").live('click', function (event) {
			event.preventDefault();
			var id = $(this).attr("id");
			var post_id = $(this).data("postid");
			
			if ($("#li_comment_" + id).find('ul').size() > 0) {
				$("#li_comment_" + id + " ul:first").prepend($("#comment_form_wrapper_"+post_id));
			} else {
				$("#li_comment_" + id).append($("#comment_form_wrapper_"+post_id));
			}
			$("#reply_id_"+post_id).attr("value", id);
			$("#cancel-comment-reply-link_"+post_id).show();
		});
	});
</script>
<style>
.comment_wrapper {
font-family:Verdana, Geneva, sans-serif;
width:100%;
}

.comment_form_wrapper{
margin: 12px 12px 12px 12px;
padding: 12px 0px 12px 12px; /* Note 0px padding right */
/*background-color: #ebefee;*/
border: thin dotted #dddddd;

}

.comment_form textarea {
width: 93%;
background: white;
border: 4px solid #EEE;
-moz-border-radius: 5px;
border-radius: 5px;
padding: 10px;
font-family:Verdana, Geneva, sans-serif;
font-size:14px;
}

#comment_resp_err{
color: red;
font-size: 13px;
}

ul.comment {
width: 100%;
/*    margin: 12px 12px 12px 0px;
padding: 3px 3px 3px 3px;*/
}

ul.comment li {
margin: 12px 12px 12px 12px;
padding: 12px 0px 12px 12px; /* Note 0px padding right */
list-style: none;             /* no glyphs before a list item */
/*background-color: #ebefee;*/
/*border: thin dotted #dddddd;*/
}

ul.comment li span.commenter {
font-weight:bold;
color:#369;
}

ul.comment li span.comment_date {
color:#666;
}

.comment_wrapper .button,.comment_wrapper .reply_button {
/* background: none repeat scroll 0 0 #5394A8;*/
color:#616770;
float: right;
font-size: 15x;

margin: -10px 5px ;
padding: 3px 10px;
text-decoration: none;
cursor: pointer;

}
.comment_wrapper .comment_submit {
float:none;
margin: 0px 5px ;
}

.comment_wrapper .button:hover, .comment_wrapper .reply_button:hover {
color:#4080ff;

}
.cancel-comment-reply-link {
color: #666;
margin-left: 10px;
margin-right:10px;
text-decoration: none;
font-size: 10px;
font-weight: normal;
float:right;
text-transform: uppercase;
}

.cancel-comment-reply-link:hover{
text-decoration: underline;
}     
</style>

