<ul class="sitemap">
	<li><a href="<?php echo base_url();?>">Home</a></li>
	<li><a href="<?php echo base_url();?>who-we-are/">Who we are</a></li>
	<li><a href="<?php echo base_url();?>contact-us/">Contact Us</a></li>
	<li><a href="<?php echo base_url();?>blog/">Blog</a></li>
	<li><a href="<?php echo base_url();?>user/signup">Sign Up</a></li>
	<li><a href="<?php echo base_url();?>businessideas/">View Business Ideas</a></li>
	<ul class="tickmark">
		<?php foreach ($industries as $key => $value) {?>
			<li><a href="<?php echo base_url();?>businessideas/<?php echo $value['slug'];?>"><?php echo $value['industry']?></a></li>
		<?php } ?>
	</ul>
	<li><a href="<?php echo base_url();?>businessideas/postidea/">Post a Business Idea</a></li>
	<li><a href="<?php echo base_url();?>terms/">Terms & Conditions</a></li>


</ul>
<style type="text/css">
	a,a:focus, a:hover {color: #498ee0 !important;cursor:pointer;}
	ul.tickmark {
	  list-style: none;
	}

	ul.tickmark li:before {
	  content: '✓';
	  font-weight: bold;
	  padding-right: 5px;
	}

	.sitemap{
		padding-left: 100px; 
	}
</style>