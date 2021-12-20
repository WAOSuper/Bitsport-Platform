<?php
/**
 * Blog Post Main File.
 *
 * @package 
 * @author  Template Path
 * @version 1.0
 */

get_header();


while(have_posts()) {
	   the_post();
	   the_content();
}
get_footer();
