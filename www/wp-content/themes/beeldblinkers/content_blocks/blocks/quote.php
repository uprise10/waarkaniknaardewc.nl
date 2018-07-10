<?php
// check current row layout
if( get_row_layout() == 'quote' ):

    // get acf fields related to each post
    $image_big = get_sub_field('foto_groot');
    $quote = get_sub_field('quote');
    $name_person = get_sub_field('naam_persoon');
    $name_company = get_sub_field('bedrijfsnaam');
    ?>

    <article class="block quote_sameheight-img">
        <div class="content">

            <div class="quote-wrap">

                <div class="image" style="background-image: url('<?php echo $image_big['sizes']['quote-bg-fw-plus-slides']; ?>')"></div>
                <div class="color"></div>

                <div class="inner">
                    <div class="text">
                        <blockquote>
                            <?php echo $quote; ?>
                        </blockquote>
                        <p class="person"><?php echo $name_person; ?> |<span> <?php echo $name_company; ?></span></p>
                    </div>
                </div>
            </div>

        </div>
    </article>

<?php endif; ?>