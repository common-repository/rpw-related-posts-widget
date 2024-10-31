<?php 
$out = '<select name="searchable[]" class="searchable" multiple="multiple">';
foreach( $posts as $p )
{
	if($post->ID != $p->ID)
	{
		if(is_array($pf_rpw_posts_arr))
		{
			if(in_array($p->ID,$pf_rpw_posts_arr))
			{
				$out .= '<option selected selected="selected" value="' . $p->ID . '" selected="selected">' . esc_html( $p->post_title ) . '</option>';
			}
			else
			{
				$out .= '<option value="' . $p->ID . '" '.$disabled.'>' . esc_html( $p->post_title ) . '</option>';
			}
		}
		else
		{
			$out .= '<option value="' . $p->ID . '" '.$disabled.'>' . esc_html( $p->post_title ) . '</option>';
		}
	}
}
$out .= '</select>';
echo $out;
?>
 <script>
    var selected = '<?php echo $pf_rpw_posts_json; ?>';
    var MAX_SELECTABLE_OPTIONS = 3,
    selectedCount = parseInt('<?php echo $selectedTotalNos; ?>')
   // alert(selectedCount);
    jQuery('.searchable').multiSelect({
    	  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search by post title'>",
    	  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search by post title'>",    	  
    	  afterInit: function(ms){
    	    var that = this,
    	        $selectableSearch = that.$selectableUl.prev(),
    	        $selectionSearch = that.$selectionUl.prev(),
    	        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
    	        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    	    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    	    .on('keydown', function(e){
    	      if (e.which === 40){
    	        that.$selectableUl.focus();
    	        return false;
    	      }
    	    });

    	    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    	    .on('keydown', function(e){
    	      if (e.which == 40){
    	        that.$selectionUl.focus();
    	        return false;
    	      }
    	    });
    	  },    	 
    	  afterSelect: afterSelect,
    	  afterDeselect: afterDeselect,
    	  selected:'<?php echo $wppf_rpw_posts_json; ?>'
    	});
	    function afterSelect (values) {
	      if (values) {
    	    selectedCount += values.length
    	  }
    	  updateMultiSelect(selectedCount)
    	}
	    function afterDeselect (values) {
	    	if (values) {
	    	    selectedCount -= values.length
	    	  }
	    	  updateMultiSelect(selectedCount)
    	}
		function updateMultiSelect(selectedCount) {
    	  var $networks = jQuery('.searchable'),
    	      selectedValues = $networks.val()

    	  if (selectedCount >= MAX_SELECTABLE_OPTIONS) {
    	    $networks.children().each(function () {
    	      if (!_.contains(selectedValues, this.value)) {
    	        //log('disabling', this.value)
    	        jQuery(this).attr('disabled', 'disabled')
    	      }
    	    })
    	  } else {
    	    $networks.children().removeAttr('disabled')
    	  }

    	  $networks.multiSelect('refresh')	
    	}	
</script>