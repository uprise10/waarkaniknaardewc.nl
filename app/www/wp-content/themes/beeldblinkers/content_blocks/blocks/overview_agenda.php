<?php
// check current row layout
if( get_row_layout() == 'agenda_overzicht' ):

    $post_objects = get_sub_field('selectie');
    $intro_title = get_sub_field('intro_titel');
    ?>

    <article id="agenda" class="block netwerk_block">
        <div class="inner">

            <div class="content">

                <div class="netwerk">

                    <div class="intro">
                        <h1><?php echo $intro_title; ?></h1>
                    </div>

                    <?php
                    if( $post_objects ):

                        foreach( $post_objects as $post): // variable must be called $post (IMPORTANT)

                            $description = get_field('korte_overzichts_omschrijving');

                            // get raw date
                            $date = get_field('datum', false, false);
                            // make date object
                            $date = new DateTime($date);
                            // echo $date->format('j M Y');
                            ?>

                            <div class="item">
                                <div class="data-bg-white"></div>
                                <div class="data">
                                    <div class="day-month-year">
                                        <div class="day"><?php echo $date->format('j'); ?></div>
                                        <div class="month-year"><span class="month"><?php echo $date->format('M'); ?></span>'<span class="year"><?php echo $date->format('y'); ?></span></div>
                                    </div>
                                </div>
                                <div class="info-wrap">
                                    <div class="text">
                                        <p><?php echo $description; ?></p>
                                    </div>
                                    <div class="button-wrap">
                                        <a class="button" href="<?php the_permalink(); ?>">Lees meer <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>

                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

                    <?php endif; ?>

                </div>


            </div>

        </div>
    </article>

<?php endif; ?>








