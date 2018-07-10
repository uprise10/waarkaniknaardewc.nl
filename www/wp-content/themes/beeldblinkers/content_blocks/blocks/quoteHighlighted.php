<?php
// check current row layout
if( get_row_layout() == 'quote_uitgelicht' ):

    // check if user selected to show all posts from custom post type or just a couple
    $post_objects = get_sub_field('selectie');

    if( $post_objects ): ?>

    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post);

        // get acf fields related to each post
        $image_big = get_field('foto_groot');
        $quote = get_field('quote');
        $name_company = get_field('bedrijfsnaam');
        ?>

        <article class="block quote_sameheight-img">

            <div class="inner">

                <div class="content">

                    <div class="text">

                        <blockquote>
                            <?php echo $quote; ?>
                        </blockquote>

                        <p class="person"><?php the_title('',''); ?> <span>| <?php echo $name_company; ?></span></p>
                        <a class="button" href="<?php the_permalink(); ?>">Lees het verhaal <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                    </div>

                    <div class="image">
                        <img src="<?php echo $image_big['sizes']['quote-plus-txt-bg']; ?>" width="<?php echo $image_big['sizes']['quote-plus-txt-bg-width']; ?>" height="<?php echo $image_big['sizes']['quote-plus-txt-bg-height']; ?>">
                    </div>

                </div>
            </div>
        </article>


    <?php endforeach; ?>

    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>

<?php endif; ?>