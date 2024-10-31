jQuery(document).ready(function() {
	setInterval(function(){ 
		var currentElement=jQuery('#rfpw_rpw_small .wppf_rpw_div_center.current');
		//alert(jQuery(currentElement).next().attr("id"));
		jQuery(currentElement).removeClass('current');
		jQuery('#rfpw_rpw_small .wppf_rpw_div_center').not('.current').hide();
		var attrId = jQuery(currentElement).next(".wppf_rpw_div_center").attr('id');
		if(typeof  attrId != 'undefined')
		{
			jQuery(currentElement).next(".wppf_rpw_div_center").addClass("current");
		}
		else
		{
			jQuery('#rfpw_rpw_small #wppf_rpw_article_1').addClass("current");
		}
		jQuery('.current').show();
		}, 5000);

    jQuery('#nxt').click(function() {
     var $cur = jQuery('.current');
     var $next = $cur.next('.wppf_rpw_div_center');
     if ($next.length == 0) 
        return false;
     
     $cur.removeClass('current');
     $next.addClass('current');
   
     jQuery('.wppf_rpw_div_center').not('.current').hide();
     jQuery('.current').show();
});

jQuery('#prev').click(function() {
       var $cur = jQuery('.current');
       var $prev = $cur.prev('.wppf_rpw_div_center');

       if ($prev.length == 0) 
         return false;
      
       $cur.removeClass('current');
       $prev.addClass('current');
    
       jQuery('.wppf_rpw_div_center').not('.current').hide();
       jQuery('.current').show();
    });
    jQuery('.rfw_close').click(function() {
 	 jQuery('.wppf_rpw_div').hide();    
    });
});

jQuery(document).ready(function($){
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;

	jQuery('.stag-metabox-table .upload-button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = jQuery(this);
		var id = button.attr('id').replace('_button', '');
		var idHidden = button.attr('id').replace('_button', '_id');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				//console.log(attachment);
				var imgVal = '<div class="thumbnail thumbnail-image"><img class="attachment-thumb" src="'+attachment.url+'" draggable="false" width="300" height="178"></div>';
				jQuery("#"+idHidden).val(attachment.id);
				jQuery("#"+id).html(imgVal);
				jQuery('#remove-button-div').html('<button type="button" class="button remove-button" id="pf_rpw_widget_no_images_button">Remove</button>');
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
		wp.media.editor.open(button);
		return false;
	});	
	/*
	jQuery('.add_media').on('click', function(){
		_custom_media = false;
	});*/
});
jQuery('.remove-button').live('click',function(e) {
	var button = jQuery(this);
	var id = button.attr('id').replace('_button', '');
	var idHidden = button.attr('id').replace('_button', '_id');
	jQuery("#"+id).html('<span>No image selected</span>');	
	jQuery("#"+idHidden).val('0');
	jQuery('#remove-button-div').empty();
	return false;
});