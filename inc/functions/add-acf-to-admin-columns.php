<?php
/*
 * Add columns to videos post list
 */
function add_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'show_playlist' => __ ( 'Video Playlist' )
    ) );
  }
  add_filter ( 'manage_videos_posts_columns', 'add_acf_columns' );

/*
 * Add columns to videos post list
 */
 function videos_custom_column ( $column, $post_id ) {
    switch ( $column ) {
        case 'show_playlist':
            echo @get_post_meta ( $post_id, 'show_playlist', true )[0];
        break;
      /* case 'custom_field':
            echo get_post_meta ( $post_id, 'custom_field', true );
        break; */
    }
  }
  add_action ( 'manage_videos_posts_custom_column', 'videos_custom_column', 10, 2 );