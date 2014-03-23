(function($) {
 
// Object for creating WordPress 3.5 media upload menu 
// for selecting theme images.
wp.media.shibaMediaManager = {
     
    init: function() {
        // Create the media frame.
        this.frame = wp.media.frames.shibaMediaManager = wp.media({
            title: 'Choose Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Insert image',
            }
        });
        
        
        // When an image is selected, run a callback.
		this.frame.on( 'select', function() {
		    // Grab the selected attachment.
		    var attachment = wp.media.shibaMediaManager.frame.state().get('selection').first(),
		        controllerName = wp.media.shibaMediaManager.$el.data('controller');
		     
		    controller = wp.customize.control.instance(controllerName);
		    controller.thumbnailSrc(attachment.attributes.url);
		    controller.setting.set(attachment.attributes.url);
		});
 
         
        $('.choose-from-library-link').click( function( event ) {
            wp.media.shibaMediaManager.$el = $(this);
            var controllerName = $(this).data('controller');
            event.preventDefault();
 
            wp.media.shibaMediaManager.frame.open();
        });
         
    } // end init
}; // end shibaMediaManager
 
wp.media.shibaMediaManager.init();
 
}(jQuery));


