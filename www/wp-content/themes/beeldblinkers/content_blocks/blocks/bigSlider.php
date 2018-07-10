<?php
// check current row layout
if( get_row_layout() == 'big_slider' ): ?>

    <?php
    $site_logo = get_field('logo', 'option');
    $slider_Type = get_sub_field('soort');

    if(!empty($slider_Type)) {

        if ($slider_Type == 'video') {

            if (have_rows('video_slides')): ?>

                    <div id="intro" class="bigslides videoslide">

                        <div class="noneslides">
                            <?php
                            // loop through the rows of data
                            while ( have_rows('video_slides') ) : the_row();

                                $bg_image = get_sub_field('achtergrond_foto');
                                $tekst = get_sub_field('tekst');
                                ?>

                                <div class="slides-cell">
                                    <div class="image">

                                        <video autoplay="autoplay" muted="muted" loop="loop">
                                            <source src="<?php echo get_template_directory_uri(); ?>/" type="video/mp4">
                                        </video>
                                        <div class="overlaycolor"></div>

                                        <img class="img-contain slideimage" src="<?php echo $bg_image['sizes']['big-slides']; ?>" width="<?php echo $bg_image['sizes']['big-slides-width']; ?>" height="<?php echo $bg_image['sizes']['big-slides-height']; ?>">

                                    </div>
                                    <div class="inner">
                                        <?php if(!empty($tekst)) { echo $tekst; } ?>

                                        <?php
                                        // check if the nested repeater field has rows of data
                                        if( have_rows('button_links') ):

                                            $i=0;
                                            // loop through the rows of data
                                            while ( have_rows('button_links') ) : the_row();

                                                $link_text = get_sub_field('naam');
                                                $link_type = get_sub_field('soort');
                                                $link_int = get_sub_field('link');
                                                $link_ext = get_sub_field('link_extern');
                                                $link_hash = get_sub_field('hashtag');

                                                if ($i == 0) {
                                                    $button_type = '';
                                                } else {
                                                    $button_type = ' white_trans';
                                                }

                                                if(!empty($link_type)) {
                                                    if($link_type == 'intern') {

                                                        if (!empty($link_int)) { ?>

                                                            <a class="button btn-yellow" href="<?php echo $link_int; ?>"><?php echo $link_text; ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>

                                                            <?php $i++; }

                                                    } else if($link_type == 'extern') {

                                                        if (!empty($link_ext)) { ?>

                                                            <a class="button btn-yellow" href="<?php echo $link_ext; ?>" target="_blank"><?php echo $link_text; ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></i></a>

                                                            <?php
                                                            $i++;
                                                        }
                                                    } else if($link_type == 'scroll') {

                                                        if (!empty($link_hash)) { ?>

                                                            <div class="scrollto">
                                                                <a class="button btn-yellow" href="<?php echo $link_hash; ?>" target="_blank"><?php echo $link_text; ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></i></a>
                                                            </div>

                                                        <?php } }
                                                }
                                                ?>

                                            <?php endwhile;

                                        endif;
                                        ?>

                                    </div>
                                </div>

                            <?php endwhile; ?>

                        </div>

                    </div>

                <?php

            endif;


        } else {

            // check if the nested repeater field has rows of data
            if (have_rows('slides')): ?>

                <div id="intro" class="bigslides">

                    <div class="slides">
                        <?php
                        // loop through the rows of data
                        while (have_rows('slides')) : the_row();

                            $bg_image = get_sub_field('achtergrond_foto');
                            $tekst = get_sub_field('tekst');
                            ?>

                            <div class="slides-cell">
                                <div class="image">

                                    <img class="img-contain" src="<?php echo $bg_image['sizes']['big-slides']; ?>"
                                         width="<?php echo $bg_image['sizes']['big-slides-width']; ?>"
                                         height="<?php echo $bg_image['sizes']['big-slides-height']; ?>">


                                </div>
                                <div class="inner">
                                    <?php if (!empty($tekst)) {
                                        echo $tekst;
                                    } ?>

                                    <?php
                                    // check if the nested repeater field has rows of data
                                    if (have_rows('button_links')):

                                        $i = 0;
                                        // loop through the rows of data
                                        while (have_rows('button_links')) : the_row();

                                            $link_text = get_sub_field('naam');
                                            $link_type = get_sub_field('soort');
                                            $link_int = get_sub_field('link');
                                            $link_ext = get_sub_field('link_extern');
                                            $link_hash = get_sub_field('hashtag');

                                            if ($i == 0) {
                                                $button_type = '';
                                            } else {
                                                $button_type = ' white_trans';
                                            }

                                            if (!empty($link_type)) {
                                                if ($link_type == 'intern') {

                                                    if (!empty($link_int)) { ?>

                                                        <a class="button btn-yellow"
                                                           href="<?php echo $link_int; ?>"><?php echo $link_text; ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>

                                                        <?php $i++;
                                                    }

                                                } else if ($link_type == 'extern') {

                                                    if (!empty($link_ext)) { ?>

                                                        <a class="button btn-yellow" href="<?php echo $link_ext; ?>"
                                                           target="_blank"><?php echo $link_text; ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>

                                                        <?php
                                                        $i++;
                                                    }
                                                } else if ($link_type == 'scroll') {

                                                    if (!empty($link_hash)) { ?>

                                                        <div class="scrollto">
                                                            <a class="button btn-yellow" href="<?php echo $link_hash; ?>"
                                                               target="_blank"><?php echo $link_text; ?> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                                                        </div>

                                                    <?php }
                                                }
                                            }
                                            ?>

                                        <?php endwhile;

                                    endif;
                                    ?>

                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>

                </div>

            <?php endif;

        }

    }
endif;
?>