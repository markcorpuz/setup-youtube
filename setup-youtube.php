<?php
/**
 * Plugin Name: Setup YouTube
 * Description: Handle the YouTube videos by displaying a thumbnail first to avoid loading the video on page load.
 * Version: 4.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/* --------------------------------------------------------------------------------------------
 * | YOUTUBE EMBEDS
 * ----------------------------------------------------------------------------------------- */
function su_youtube_advanced_func( $atts ) {

    $a = shortcode_atts( array( 
        'url' => 'url',
        'autohide' => 'autohide',
        'https' => 'https',
        'class' => 'class',
    ), $atts );
    // $a['url'], $a['autohide'], $a['https'], $a['class']
    $vid = explode( "/", $a['url'] );
    $video_id = count($vid) - 1;
    
    $exp_vid = explode( "=", $vid[$video_id] );
    if( count( $exp_vid ) > 1 ) {
       // not using the embed URL
       $youtubeid = $exp_vid[count( $exp_vid ) - 1];
    } else {
       // using the embed URL
       $youtubeid = $vid[$video_id];
    }

    // check if site requested is secured
    if( $a['https'] == 'yes' ) {
        $secured = 'https';
    } else {
        $secured = 'http';
    }

    // download thumbnail
    //spk_download_youtube_thumb( $youtubeid ); // DEPRECATED ON 20190919 ######################################

    // NOTE: browser caching retains the same image even after replacement
    // DEPRECATED ON 20190919 ######################################
    //$ytthumb_w_ver = plugins_url( "../images/youtubethumbs/0/".$youtubeid.".jpg", __FILE__ ); //."?".date( 'YmdHis', filemtime( plugin_dir_path( __FILE__ )."../images/youtubethumbs/0/".$youtubeid.".jpg" ) );
    //                         <!--img src="'.$secured.'://img.youtube.com/vi/'.$youtubeid.'/0.jpg" class="thumbnail" id="thumbnail_'.$youtubeid.'" / -->
    $return = '<div class="module-video" id="'.$youtubeid.'">
                    <div class="video-image" id="video_image_'.$youtubeid.'"><div class="module-wrap">
                        <div class="video-play" id="video_play_'.$youtubeid.'"></div>
                        <img src="https://img.youtube.com/vi/'.$youtubeid.'/0.jpg" class="thumbnail" id="thumbnail_'.$youtubeid.'" />
                    </div></div>
                </div>';
    
    return $return;
    
}

/* --------------------------------------------------------------------------------------------
 * | DOWNLOAD YOUTUBE THUMBNAIL
 * ----------------------------------------------------------------------------------------- */
/*function spk_download_youtube_thumb( $youtubeid ) {

    $spk_file_dir = plugin_dir_path( __FILE__ ).'../images/youtubethumbs/0/';
        
    // set filename
    $filename = $spk_file_dir.$youtubeid.'.jpg';

    // set source
    $value = 'https://img.youtube.com/vi/'.$youtubeid.'/0.jpg';
    
    $key = NULL; // not really required but just good to have in place

    if( file_exists( $filename ) ) {

        // validate time stamps
        $start      = date('Y-m-d H:i:s'); 
        $end        = date('Y-m-d H:i:s',filemtime( $filename )); 
        $d_start    = new DateTime($start); 
        $d_end      = new DateTime($end); 
        $diff       = $d_start->diff($d_end);
        //var_dump($diff); echo '<hr>';

        $file_age = 14;

        // $diff->d for days | $diff->h for hours | $diff->i for minutes
        if( $diff->d >= $file_age ) {
            //echo $diff->d.' > '.$file_age.' <br />';
            spk_download_external_files_now( $filename, $key, $value );
        }

    } else {
        // file doesn't exists
        //echo "file doesn't exists.";
        spk_download_external_files_now( $filename, $key, $value );
    }

}*/

/* --------------------------------------------------------------------------------------------
 * | ENQUEUE SCRIPTS
 * ----------------------------------------------------------------------------------------- */
function setup_youtube_scripts() {
    
    // last arg is true - will be placed before </body>
    wp_register_script( 'setup_youtube_scripts', plugins_url( 'js/asset.js', __FILE__ ), NULL, '1.0', TRUE );
     
    // Localize the script with new data
    /*$translation_array = array(
        'spk_master_one_ajax' => plugin_dir_url( __FILE__ ).'../ajax/spk_master_plug_v1_ajax.php',
    );
    wp_localize_script( 'spk_master_plugins_v1_js', 'spk_master_one', $translation_array );
    */
    // Enqueued script with localized data.
    wp_enqueue_script( 'setup_youtube_scripts' );

}

/* --------------------------------------------------------------------------------------------
 * | EXECUTE
 * ----------------------------------------------------------------------------------------- */
if ( !is_admin() ) {

	// ENQUEUE SCRIPTS
    //add_action( 'wp_enqueue_scripts', 'setup_youtube_scripts' );
    add_action( 'wp_footer', 'setup_youtube_scripts', 5 );

    // SHORTCODE - YOUTUBE EMBEDS
    add_shortcode( 'su_youtube_advanced', 'su_youtube_advanced_func' );

}