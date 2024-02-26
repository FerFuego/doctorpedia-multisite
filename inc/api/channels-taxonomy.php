<?php

add_action('rest_api_init', 'channelsTaxonomy');

function channelsTaxonomy()
{
    register_rest_route('doctorpedia/v2', 'channels-taxonomy', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'getChannelsTaxonomy'
    ]);
}

function getChannelsTaxonomy($data)
{
    $search = $data['search'];

    if($search != ''){

        $args = array(
            'taxonomy'      => array('categories-category'), // taxonomy name
            'orderby'       => 'id',
            'order'         => 'ASC',
            'hide_empty'    => true,
            'fields'        => 'all',
            'parent' => 0,
            'name__like'    => $search,
            'meta_key'		=> 'type',
            'meta_value'	=> 'specialty-area'
    
        );
    
        $terms = get_terms($args);
    
        $count = count($terms);
    
        $options = '';
        if ($count > 0) {
            foreach ($terms as $term) {
                $options .= "<li><a href='" . get_term_link($term) . "'>" . $term->name . "</a></li>";
            }
    
            return array(
                'items' => true,
                'data' => $options 
            );
        }
    
        return array(
            'items' => false,
            'data' => __('Nothing Found...', 'Doctopredia')
        );
    }else{
        return array(
            'items' => false,
            'data' => ''
        );
    }

}
