<div class="bigslides slidelow">

    <div class="noneslides">
        <?php
        // loop through the rows of data
        $bg_image = get_field('header_foto', 'option');
        $ibpix_the_title = get_the_title();
        ?>

        <div class="slides-cell">
            <div class="image">
                <img src="<?php echo $bg_image['sizes']['big-slides']; ?>" width="<?php echo $bg_image['sizes']['big-slides-width']; ?>" height="<?php echo $bg_image['sizes']['big-slides-height']; ?>">
            </div>
            <div class="inner">

                <?php if (is_singular('post')) { ?>
                    <p class="singleTitle">Nieuws</p>
                <?php } else if (is_singular('agenda')) { ?>
                    <p class="singleTitle">Agenda</p>
                <?php } else if (is_front_page()) { ?>
                    <p class="singleTitle">Nieuws</p>
                <?php } else if (is_singular('page')) { ?>
                    <p class="singleTitle"><?php the_title(); ?></p>
                <?php } else { ?>
                    <p class="singleTitle">Nieuws</p>
                <?php } ?>

            </div>
        </div>

    </div>

    <?php /* ?>
    <div class="slide_bg_position">
        <div class="slide_bg_wrap">
            <svg class="slide_bg_white" width="67px" height="221px" viewBox="-2046 5214 67 221" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <polygon stroke="none" fill="#ffffff" fill-rule="evenodd" points="-1979.867 5214 -1979 5434.29619 -2046 5323.32783"></polygon>
            </svg>
            <svg class="slide_bg_blue" width="67px" height="221px" viewBox="-2046 5214 67 221" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <polygon stroke="none" fill="#001d3d" fill-rule="evenodd" points="-1979.867 5214 -1979 5434.29619 -2046 5323.32783"></polygon>
            </svg>
        </div>
    </div>
    <?php */ ?>

</div>