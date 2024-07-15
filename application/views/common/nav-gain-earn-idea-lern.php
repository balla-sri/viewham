<?php $navpage = $this->uri->segment('1'); ?>
<nav class="nav-bar">
			<div class="container">
			<a href="<?php echo base_url('ideazone'); ?>" class="<?php if($navpage=='ideazone' || $navpage=='Ideazone'){ echo 'active'; } ?>">Idea Zone</a>
			<a href="<?php echo base_url('gain'); ?>" class="<?php if($navpage=='Gain'|| $navpage=='gain'){ echo 'active'; } ?>">Gain</a>
			<a href="<?php echo base_url('earn'); ?>" class="<?php if($navpage=='earn' || $navpage=='Earn'){ echo 'active'; } ?>">Earn</a>
			<a href="<?php echo base_url('learn'); ?>" class="<?php if($navpage=='Learn'|| $navpage=='learn'){ echo 'active'; } ?>">Learn</a>
		</div>
	</nav>