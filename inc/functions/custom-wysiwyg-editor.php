<?php
    //Custom wysiwyg for Underline and Bold
    add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
    function my_toolbars( $toolbars )
    {
        // Add a new toolbar called "Very Simple"
        // - this toolbar has only 1 row of buttons
        $toolbars['Underline Only' ] = array();
        $toolbars['Underline Only' ][1] = array('underline' );
        // Edit the "Full" toolbar and remove 'code'
        // - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
        if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
        {
            unset( $toolbars['Full' ][2][$key] );
        }
        // remove the 'Basic' toolbar completely
        unset( $toolbars['Basic' ] );
        // return $toolbars - IMPORTANT!
        return $toolbars;
    }

    //Custom wysiwyg for Link only
    add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars_link'  );
    function my_toolbars_link( $toolbars )
    {
        // Add a new toolbar called "Very Simple"
        // - this toolbar has only 1 row of buttons
        $toolbars['Link Only' ] = array();
        $toolbars['Link Only' ][1] = array( 'link' );
        $toolbars['Bold' ] = array();
        $toolbars['Bold' ][1] = array( 'bold' );
        // Edit the "Full" toolbar and remove 'code'
        // - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
        if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
        {
            unset( $toolbars['Full' ][2][$key] );
        }
        // remove the 'Basic' toolbar completely
        unset( $toolbars['Basic' ] );
        // return $toolbars - IMPORTANT!
        return $toolbars;
    }