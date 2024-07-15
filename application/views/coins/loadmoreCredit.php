 <?php if(!empty($posts)){ foreach($posts as $c){ ?>
<li>
<p>You got <b><?php echo $c['credit']; ?> Coins</b> for <b><?php echo $c['id']; ?></b></p>										
</li>
<?php } ?>
    <?php if($postNum > $postLimit){ ?>
        <div class="load-more_credit" lastID="<?php echo $c['id']; ?>" style="display: none;">
           Loading more posts...
        </div>
		<a class="see_more_credit link" >See Moree.. </a>	
    <?php }else{ ?>
        <div class="load-more_credit" lastID="0">
            That's All!
        </div>
    <?php } ?>    
<?php }else{ ?>    
    <div class="load-more_credit" lastID="0">
            That's All!
    </div>    
<?php } ?>