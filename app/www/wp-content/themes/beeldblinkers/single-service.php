<?php get_header(); ?>

<?php
// Start the loop.
while ( have_posts() ) : the_post();

    $image = get_field('bedrijfslogo');
    $image_additional = get_field('additionele_foto');
    ?>

    <article class="block partner_detail">
        <div class="inner">

            <div class="person_image">
                <?php if(!empty($image_additional)) {
                    ?>
                    <img src="<?php echo $image_additional['sizes']['projecten-partners-additional']; ?>">
                <?php } else {
                    ?>
                    <img src="<?php echo $image['sizes']['projecten-partners-additional']; ?>">
                <?php } ?>
            </div>

            <div class="content article">

                <?php the_title('<h1>', '</h1>'); ?>
                <?php the_content(); ?>

                <hr>

                <div class="info_contact">
                    <h2>Neem contact op met <?php the_title('', ''); ?></h2>
                    <p>Vul hieronder je gegevens in</p>

                    <div class="form">
                        <input type="text" placeholder="Naam*">
                        <input type="email" placeholder="E-mail*">
                        <input type="text" placeholder="Onderwerp*">
                        <textarea name="vraag" id="" cols="30" rows="10" placeholder="Stel je vraag*"></textarea>
                        <input type="submit" class="button green" value="Verzenden">
                    </div>

                </div>

            </div>

        </div>
    </article>

<?php endwhile; ?>

<?php get_footer(); ?>