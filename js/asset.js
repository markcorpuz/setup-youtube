/* --------------------------------------------------------------------------------------------
 * | YOUTUBE EMBEDS
 * ----------------------------------------------------------------------------------------- */
jQuery( 'div.module-video' ).each( function() {
    
    var yt_id = this.id;

    /* ------------------------
     * | PLAY BUTTON
     * --------------------- */
    jQuery( '#video_play_' + yt_id ).on( 'click', function() {

        // hide play button and thumbnail div
        HideThisDiv( '#video_image_' + yt_id );
        
        // append video
        AppendVideo( yt_id );

    });
    
    /* ------------------------
     * | THUMBNAIL
     * --------------------- */
    jQuery( '#thumbnail_' + yt_id ).on( 'click', function() {
        
        // hide play button and thumbnail div
        HideThisDiv( '#video_image_' + yt_id );

        // append video
        AppendVideo( yt_id );
    
    });
    
});

/* Hide Element */
function HideThisDiv( ThisElement ) {

    jQuery( ThisElement ).hide();

}

/* Append Video to DIV */
function AppendVideo( yt_ids ) {
    
    jQuery( 'div#' + yt_ids )
        .append( '<div class="video-youtube"><div class="module-wrap">' +
                    '<iframe width="420" height="315" id="video_iframe" src="https://www.youtube.com/embed/' + yt_ids + '?autoplay=1" frameborder="0" allowfullscreen></iframe>' +
                 '</div></div>' );
    
}