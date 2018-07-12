<?php get_header(); ?>

<?php
// Start the loop.
while ( have_posts() ) : the_post();

    $work_title = get_field('functie_titel');
    $image = get_field('foto');
    $twitter_url = get_field('twitter_url');
    $linkedin_url = get_field('linkedin_url');
    $facebook_url = get_field('facebook_url');
    $website_url = get_field('website_url');
    ?>

    <article class="block team_person">
        <div class="inner">

            <div class="person_image">
                <?php if(!empty($image)) { ?>
                    <img src="<?php echo $image['sizes']['projecten-partners-additional']; ?>">
                <?php } ?>
            </div>

            <div class="content article">

                <?php the_title('<h1>','</h1>'); ?>
                <?php if(!empty($work_title)) { ?>
                    <p class="worktype"><?php echo $work_title; ?></p>
                <?php } ?>

                <?php the_content(); ?>

                <div class="info_footer">

                    <?php if(!empty($linkedin_url)) { ?>
                        <a href="<?php echo $linkedin_url; ?>" class="button green" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    <?php } ?>

                    <?php if(!empty($facebook_url)) { ?>
                        <a href="<?php echo $facebook_url; ?>" class="button green" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <?php } ?>

                    <?php if(!empty($twitter_url)) { ?>
                        <a href="<?php echo $twitter_url; ?>" class="button green" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <?php } ?>

                    <?php if(!empty($website_url)) { ?>
                        <a href="<?php echo $website_url; ?>" class="button green" target="_blank">website <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <?php } ?>

                </div>

            </div>

        </div>
    </article>

<?php endwhile; ?>

<?php get_footer(); ?>