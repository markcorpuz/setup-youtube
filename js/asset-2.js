(function($) {
	
	$( 'div.module-video' ).each( function() {
		
		var yt_id = this.id,
			yt_link = 'https://www.youtube.com/embed/' + yt_id + '?autoplay=1';

	    /* ------------------------
	     * | WHOLE DIV
	     * --------------------- */
	    $( '#video_image_' + yt_id ).on( 'click', function() {
	        
	        // append video
			$( '#' + yt_id ).html( '<div class="video-youtube"><div class="module-wrap"><iframe width="420" height="315" id="video_iframe" src="'+yt_link+'" frameborder="0" allowfullscreen></iframe></div></div>' );

	    });

	});

})( jQuery );