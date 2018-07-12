<?php get_header(); ?>

    <article class="block team bg-grey">
        <div class="inner">

            <div class="content">

                <div class="intro">
                    <?php
                    $archive_title = get_field('team_titel', 'option');
                    $archive_desc = get_field('team_omschrijving', 'option');

                    if(!empty($archive_title)) {
                        echo '<h1>' . $archive_title . '</h1>';
                    } else { ?>
                        <h1><?php post_type_archive_title(); ?></h1>
                    <?php } ?>

                    <?php if(!empty($archive_desc)) {
                        echo $archive_desc;
                    } ?>
                </div>

                <div class="overview">

                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                        // get acf fields related to each post
                        $work_title = get_field('functie_titel');
                        $twitter_url = get_field('twitter_url');
                        $linkedin_url = get_field('linkedin_url');
                        $facebook_url = get_field('facebook_url');
                        $image = get_field('foto');
                        ?>

                        <div class="item">
                            <div class="text">
                                <div class="image">
                                    <img class="img-contain" src="<?php echo $image['url']; ?>" alt="">
                                </div>
                                <a href="<?php the_permalink(); ?>" class="textwrap">
                                    <?php the_title('<h2>','</h2>'); ?>
                                    <p><?php echo $work_title; ?></p>
                                </a>
                            </div>
                            <div class="extra_info">
                                <div class="position">
                                    <p>Volg mij op</p>
                                    <?php if(!empty($twitter_url)) { ?>
                                        <a href="#" class="button white_trans"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <?php if(!empty($linkedin_url)) { ?>
                                        <a href="#" class="button white_trans"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <?php if(!empty($facebook_url)) { ?>
                                        <a href="#" class="button white_trans"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>

                </div>
            </div>

        </div>
    </article>

<?php get_footer(); ?>