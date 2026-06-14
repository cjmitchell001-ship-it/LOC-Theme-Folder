<?php
// Fallback template — all real templates are handled by page-specific files.
get_header();
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        the_content();
    }
}
get_footer();
