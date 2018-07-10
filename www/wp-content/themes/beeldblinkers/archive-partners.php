<?php get_header(); ?>

    <article class="block netwerk_block">
        <div class="inner">

            <div class="content">

                <div class="intro">
                    <?php
                    $archive_title = get_field('partners_titel', 'option');
                    $archive_desc = get_field('partners_omschrijving', 'option');

                    if(!empty($archive_title)) {
                        echo '<h1>' . $archive_title . '</h1>';
                    } else { ?>
                        <h1><?php post_type_archive_title(); ?></h1>
                    <?php } ?>

                    <?php if(!empty($archive_desc)) {
                        echo $archive_desc;
                    } ?>
                </div>

                <div class="netwerk">

                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                        // get acf fields related to each post
                        $short_description = get_field('omschrijving_voor_overzicht');
                        $logo = get_field('bedrijfslogo');
                        ?>

                        <div class="item">
                            <div class="logo">
                                <img src="<?php echo $logo['url']; ?>">
                            </div>
                            <div class="text">
                                <?php the_title('<h2>','</h2>'); ?>
                                <p><?php echo $short_description; ?></p>
                                <a class="leesmeer" href="<?php the_permalink(); ?>">Lees meer <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>


                    <?php endwhile; ?>

                </div>

                <div class="partner_footer">
                    <h2>Wilt u ook partner van Landmerc+ worden?</h2>
                    <p>Neem contact met ons op om er achter te komen hoe wij elkaar versterken!</p>
                    <a href="#" class="leesmeer">Neem contact op <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>

            </div>

        </div>
    </article>

<?php get_footer(); ?>