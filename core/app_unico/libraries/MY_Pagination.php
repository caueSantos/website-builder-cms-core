<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * FTP Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/ftp.html
 */
class MY_Pagination extends CI_Pagination {

    var $base_url = '/'; // The page we are linking to
    var $prefix = ''; // A custom prefix added to the path.
    var $suffix = ''; // A custom suffix added to the path.
    var $total_rows = 0; // Total number of items (database results)
    var $per_page = 10; // Max number of items you want shown per page
    var $num_links = 2; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page = 0; // The current page being viewed
    var $use_page_numbers = FALSE; // Use page number for segment instead of offset
    var $prev_tag_open = "<li class='page-item'>";
    var $prev_tag_close = "</li>";
    var $next_tag_open = "<li class='page-item'>";
    var $next_tag_close = "</li>";
    var $num_tag_open = "<li class='page-item'>";
    var $num_tag_close = "</li>";
    var $first_tag_open = "<li class='page-item'>";
    var $first_tag_close = "</li>";
    var $last_tag_open = "<li class='page-item'>";
    var $last_tag_close = "</li>";
    var $cur_tag_open = "<li class='page-item active'><span>";
    var $cur_tag_close = "</span></li>";
    var $first_link = "Primeira Página";
    var $last_link = "Última Página";
    var $next_link = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
    var $prev_link = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
    var $uri_segment = 3;
    var $full_tag_open = '';
    var $full_tag_close = '';
    var $first_url = ''; // Alternative URL for the First Page.
    var $page_query_string = FALSE;
    var $query_string_segment = 'page';
    var $display_pages = TRUE;
    var $anchor_class = '';

}

// END FTP Class

/* End of file Ftp.php */
/* Location: ./system/libraries/Ftp.php */
