<?php
    // if user selected just a couple of posts then set up an array of post objects for the custom post type
    $query = new WP_Query(
        array(
            'post_type' => 'ervaringen'
        )
    );
    $post_objects = $query->posts;

    if( $post_objects ): ?>


        <article class="block overige_ervaringen">
            <div class="inner">

                <div class="content">

                    <h2>Overige ervaringen</h2>

                    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post);

                        // get acf fields related to each post
                        $quote = get_field('quote');
                        ?>

                        <div class="item">
                            <p>
                                "<?php echo $quote; ?>
                                <a href="<?php the_permalink(); ?>">lees meer <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </p>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>
        </article>

    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

<?php endif; ?>