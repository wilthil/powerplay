(function($){
   // 'use strict';
   
    	
    $.fn.addMediaUpload = function() {
    	
    	/*
    	$('.remove-image').hide();
		
    	if( $('.add-image').parent().find('input').val() !== ''){
			$('.add-image').hide().next().show();
		}
		*/
		
		$(document).on('click','.add-image',function(e) {
							
			e.preventDefault();
			
			var handle = $(this);
	 				
			frame = wp.media({
			 	title : 'Select image',
			 	frame: 'post',
			 	multiple : false, // set to false if you want only one image
			 	library : { type : 'image'},
			 	button : { text : 'Use image' },
			});
			
			frame.on('close',function(data) {
			 	var imageArray = [];
			 	images = frame.state().get('selection');
			 	images.each(function(image) {
					imageArray.push(image.attributes.url);										
				 });
	 
				 $(handle).prev().val(imageArray.join(",")); // Adds all image URL's comma seperated to a text input
			 
				 $(handle).parent().find('.image-container').append('<img src="'+ imageArray.join(",") + '" style="max-width:200px;"/>');
				 $(handle).hide().next().show();
			});
			
			frame.open();
	
		});
		
		$(document).on('click','.remove-image', function(e) {
			
			e.preventDefault();
			$(this).prev().show();
			$(this).hide().parent().find('input').val('');
		
		});
       	
		
	};  

}( jQuery ));




jQuery(document).ready(function($){
	    
	$('#grid-styles-dialog').addMediaUpload();
	
	
	
	    
});