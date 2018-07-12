<?php
// check if the flexible content field has rows of data
if( have_rows('content_blokken') ):

// loop through the rows of data
while ( have_rows('content_blokken') ) : the_row();

    // 1 coloms tekstblock
    get_template_part('content_blocks/blocks/text_block');
    // 2 coloms tekstblock
    get_template_part('content_blocks/blocks/text_block_2col');
    // 3 coloms tekstblock
    get_template_part('content_blocks/blocks/text_block_3col');
	// BigSlider
    get_template_part('content_blocks/blocks/bigSlider');
    // Info full width
    get_template_part('content_blocks/blocks/infoFullWidth');
    // Latest News
    get_template_part('content_blocks/blocks/overview_latestnews');
    // Newsletter
    get_template_part('content_blocks/blocks/newsletter');
    // Functionaliteiten
    get_template_part('content_blocks/blocks/overview_agenda');
	// contact block
    //get_template_part('content_blocks/blocks/contactBlock');
    // quote block
    get_template_part('content_blocks/blocks/quote');
	// logos
    get_template_part('content_blocks/blocks/logos');

endwhile;

else :

// no layouts found

endif;
?>