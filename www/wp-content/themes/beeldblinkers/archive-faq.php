<?php get_header(); ?>

<article class="block faq_block">

    <div class="inner">

        <div class="content">

            <div class="intro">
                <?php
                $archive_title = get_field('faq_titel', 'option');
                $archive_desc = get_field('faq_omschrijving', 'option');

                if(!empty($archive_title)) {
                    echo '<h1>' . $archive_title . '</h1>';
                } else { ?>
                    <h1><?php post_type_archive_title(); ?></h1>
                <?php } ?>

                <?php if(!empty($archive_desc)) {
                    echo $archive_desc;
                } ?>
            </div>

            <ul class="faqs">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    $antwoord = get_field('antwoord');
                    ?>

                    <?php
                    // get acf fields related to each post
                    $answer = get_field('antwoord');
                    ?>

                    <li class="question">
                        <div class="question_wrap">
                            <?php the_title('<h2>','</h2>'); ?>
                        </div>
                        <ul class="answer">
                            <li>
                                <?php echo $answer; ?>
                            </li>
                        </ul>
                    </li>

                <?php endwhile; ?>

            </ul>

        </div>

    </div>

</article>

<?php get_footer(); ?>