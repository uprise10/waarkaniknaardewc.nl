<?php get_header(); ?>
    <main>

        <div class="block filter_portfolio">
            <div class="inner">
                <div class="filter_wrap">

                    <div class="filter_toggle_options">
                        <div class="bg-wrap">
                            <span>Filter op </span> <span class="current_filter"> Alles </span> <span class="icon"><span class="close"></span></span>
                        </div>
                    </div>

                    <ul class="filter_options">
                        <li><a href="#">branding</a></li>
                        <li><a href="#">print</a></li>
                        <li><a href="#">animatie</a></li>
                        <li><a href="#">webdesign</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <article class="block portfolio_archive">
            <div class="inner">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                    // get acf fields related to each post
                    $description_small = get_field('korte_overzichts_omschrijving');
                    $mouse_over_description = get_field('mouse_over_omschrijving');
                    $image = get_field('foto');
                    ?>

                    <a class="item reveal_in_viewport" href="<?php echo get_the_permalink(); ?>">
                        <div class="text">
                            <div class="image">
                                <img class="img-contain" src="<?php echo $image['url'];?>" alt="">
                            </div>
                        </div>
                        <div class="extra_info">
                            <div class="centered_text">
                                <?php the_title('<h2>','</h2>'); ?>
                                <p><?php echo $mouse_over_description; ?></p>
                            </div>
                        </div>
                    </a>

                <?php endwhile; ?>

                <button class="button">Toon meer werk</button>

            </div>
        </article>

    </main>
<?php get_footer(); ?>