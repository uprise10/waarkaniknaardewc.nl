<?php
// check current row layout
if( get_row_layout() == 'ervaringen' ):

    // check if user selected to show all posts from custom post type or just a couple
    if( get_sub_field('niet_alles_tonen') == 'Nee' ) {
        $post_objects = get_sub_field('personen');
    } else {
        // if user selected just a couple of posts then set up an array of post objects for the custom post type
        $query = new WP_Query(
            array(
                'post_type' => 'team'
            )
        );
        $post_objects = $query->posts;
    }

    $intro_title = get_sub_field('intro_titel');
    $intro_text = get_sub_field('intro_tekst');
    ?>




                    <?php if( $post_objects ): ?>

                        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                            <?php setup_postdata($post);

                            // get acf fields related to each post
                            // $work_title = get_field('functie_titel');

                            ?>


                        <?php endforeach; ?>

                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>



<?php endif; ?>








