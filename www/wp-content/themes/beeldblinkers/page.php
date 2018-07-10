<?php get_header(); ?>
<main>

    <?php
    if ( ! post_password_required() ) {
        get_template_part('content_blocks/loop');
    }

    else { ?>

    <article class="protected_page block">

        <div class="inner">

            <div class="content">

                <div class="text">

                    <h3>Inloggen 'Mijn TVMS'</h3>

                    <?php echo get_the_password_form(); ?>

                </div>
            </div>
        </div>
    </article>

    <?php }
    ?>


</main>
<?php get_footer(); ?>