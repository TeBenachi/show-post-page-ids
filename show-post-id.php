<?php

/** 
 * @package Showpostpageid
 * @author  Benachi
 * @license GPL-2.0-or-later
 * 
 * Plugin Name: Show post and page id
 * Description: Display post and page IDs on admin page. 
 * Version: 1.0
 * Author: Benachi
 * Requires PHP: 7.3
 * Requires at least: 4.6
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 **/

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit; 
}

// Load plugin when user is in admin panel only
if (! is_admin()) {
    return; 
}

/**
 * Set the new ID column width 
 */
function setIdColumnWidth()
{
    ?>
    <style type="text/css">
        .wp-admin table .column-postids, .wp-admin table .column-pageids {width: 9%;}
    </style>
<?php }
add_action('admin_head', 'setIdColumnWidth');

/**
 * Adding a new column for the post id. 
 * 
 * @return string Text New column
 */
function postIdColumn($columns) 
{
    $columns['postids'] = __('ID', 'postId');
    return $columns;
}
add_filter('manage_posts_columns', 'postIdColumn', '10', '1');

/**
 * Insert the post id into the ID column. 
 * 
 * @param string $column_name Which column is currently selected.
 * @param string $post_id     Which post id is currently selected.
 */
function addPostId($column_name, $post_id) 
{
    if ($column_name === 'postids') {
        echo get_the_ID($post_id);
    }
}
add_action('manage_posts_custom_column', 'addPostId', 10, 2);


/**
 * Adding a new column for the page id. 
 * 
 * @return string $columns Which column is currently selected.
 */
function pageIdColumn($columns) 
{
    $columns['pageids'] = __('ID', 'pageId');
    return $columns;
}
add_filter('manage_pages_columns', 'pageIdColumn', '10', '1');

/**
 * Insert the page id into the ID column. 
 * 
 * @param string $columns_name Which column is currently selected.
 * @param string $page_id      Which page id is currently selected.
 */
function addPageId($column_name, $page_id) 
{
    if ($column_name === 'pageids') {
        echo get_the_ID($page_id);
    }
}
add_action('manage_pages_custom_column', 'addPageId', 10, 2);