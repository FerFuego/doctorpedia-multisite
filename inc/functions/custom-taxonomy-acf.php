
<?php
function hide_child_taxonomies($args, $field)
{
    if ('interest_channels' === $field['_name']) {
        $args['parent'] = 0;
        $args['meta_key'] = 'type';
        $args['meta_value'] = 'interest-channel';
    }
    return $args;
}

add_filter('acf/fields/taxonomy/query', 'hide_child_taxonomies', 10, 3);
