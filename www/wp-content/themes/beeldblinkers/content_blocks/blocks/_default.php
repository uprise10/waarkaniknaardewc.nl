<?php
// check current row layout
if( get_row_layout() == 'big_slider' ):

    $bg_image = get_sub_field('achtergrond_foto');
    $title = get_sub_field('titel');
    $tekst = get_sub_field('tekst');

    // check if the nested repeater field has rows of data
    if( have_rows('button_links') ):

        // loop through the rows of data
        while ( have_rows('button_links') ) : the_row();

            $name = get_sub_field('naam');
            $link = get_sub_field('link');
            //$color = get_sub_field('color');

            echo '<img class="img-circle" src="' . $foto['url'] . '" alt="demo">';

        endwhile;

    endif;

endif;
?>



custom post type loop

<?php
// check current row layout
if( get_row_layout() == 'team' ):

    /*
    *  Loop through post objects (assuming this is a multi-select field) ( setup postdata )
    *  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
    *  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
    */

    $post_objects = get_sub_field('personen');

    if( $post_objects ): ?>


        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>

            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            Field value: <?php the_field('functie_titel'); ?>

        <?php endforeach; ?>


        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif;

    /*
    *  Loop through post objects (assuming this is a multi-select field) ( don't setup postdata )
    *  Using this method, the $post object is never changed so all functions need a seccond parameter of the post ID in question.
    */

    $post_objects = get_sub_field('personen');

    if( $post_objects ): ?>

        <?php foreach( $post_objects as $post_object): ?>

            <p>Post Object ID: <?php echo $post_object->ID; ?></p>

        <?php endforeach; ?>

    <?php endif; ?>

<?php endif; ?>
