<?php if(count($pf_rpw_posts_display_arr) > 0){ ?>
<div class="col-sm-2 wppf_rpw_div" id="<?php echo $pf_rpw_style_id; ?>">
    <div class="row">
    	<div class="col-sm-1 wppf_rpw_div_left" id="prev"><i class="fa fa-chevron-left"></i></div>
    	<?php
    	$i = 0;
	  	foreach ($pf_rpw_posts_display_arr as $key=>$val)
	  	{ 
	  		$i++; 
		  	if($i == 1)
		  	{
		  		$current = 'current';
		  	}
		  	else 
		  	{
		  		$current = '';
		  	}
		  	?>
		  	<?php
		  	if($pf_rpw_style == 'small')
		  	{
		  		?>
  		  		<div  class="col-sm-12 wppf_rpw_div_center <?php echo $current; ?>" id="wppf_rpw_article_<?php echo $i; ?>">
  		  		 	<div class="col-sm-2 wppf_rpw_div_image"><?php echo $val['image']; ?></div>
  		  		    <div class="col-sm-10 wppf_rpw_div_title"><a href="<?php echo $val['link']?>"><?php echo $val['title']; ?></a></div>
  		  			<div class="col-sm-1 wppf_rpw_article_close rfw_close" id="rfw_close" ><i class="fa fa-times"></i></div>
  		  		</div>
  		  	<?php	  		
  			} 
		  	elseif($pf_rpw_style == 'medium')
		  	{
		  		?>
	  			<div class="col-sm-10 wppf_rpw_div_center <?php echo $current; ?>" id="wppf_rpw_article_<?php echo $i; ?>">
	  			  	<div class="col-sm-4 wppf_rpw_div_image"><?php echo $val['image']; ?></div>
	  			    <div class="col-sm-7 wppf_rpw_div_title"><a href="<?php echo $val['link']?>"><?php echo $val['title']; ?></a></div>
	  				<div class="col-sm-1 wppf_rpw_article_close rfw_close" id="rfw_close" ><i class="fa fa-times"></i></div>
	  		     </div>
	  		<?php	  		
		  	}
		  	elseif($pf_rpw_style == 'large')
		  	{ ?>
		  		<div class="col-md-10 wppf_rpw_div_center <?php echo $current; ?>" id="wppf_rpw_article_<?php echo $i; ?>">
			    	<div class="wppf_rpw_article_close rfw_close" id="rfw_close" ><i class="fa fa-times"></i></div>   
			    	<div class="wppf_rpw_div_image"><?php echo $val['image']; ?></div>
			    	<div class="wppf_rpw_div_title"><a href="<?php echo $val['link']?>"><?php echo $val['title']; ?></a></div>
			    	<div class="wppf_rpw_div_decs"><?php echo $val['descriptions']; ?></div>			    	 	
	         	</div>
		  	<?php }
		  	else
		  	{ ?>
		  		<div class="col-sm-10 wppf_rpw_div_center <?php echo $current; ?>" id="wppf_rpw_article_<?php echo $i; ?>">
			    	<div class="col-sm-4 wppf_rpw_div_image"><?php echo $val['image']; ?></div>
			        <div class="col-sm-7 wppf_rpw_div_title"><a href="<?php echo $val['link']?>"><?php echo $val['title']; ?></a></div>
			        <div class="col-sm-1 wppf_rpw_article_close rfw_close" id="rfw_close" ><i class="fa fa-times"></i></div>
	        	</div>
		  	<?php }
	  	} 
  		?>
        <div class="col-sm-1 wppf_rpw_div_right" id="nxt"><i class="fa fa-chevron-right"></i></div>
	</div>
</div>
<?php } ?>