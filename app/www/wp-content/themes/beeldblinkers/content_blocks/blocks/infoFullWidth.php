<?php
// check current row layout
if( get_row_layout() == 'info_volle_breedte' ):

    $title = get_sub_field('titel');
    $text = get_sub_field('tekst');
    $text_2 = get_sub_field('colom_2');
    $background = get_sub_field('achtergrond');
    ?>

    <article id="over-ons" class="block info_fullwidth">

        <div class="cover_img" style="background-image: url('<?php echo $background['sizes']['quote-bg-fw-plus-slides'] ?>')"></div>

        <div class="inner">

            <div class="content">

                <div class="colom">
                    <?php echo $text; ?>
                </div>
                <div class="colom">
                    <?php echo $text_2; ?>

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

                            if(!empty($link_type)) {
                                if($link_type == 'intern') {
                                    if (!empty($link_int)) { ?>

                                        <a class="button" href="<?php echo $link_int; ?>"><?php echo $link_text; ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                        <?php $i++; } } else {
                                    if (!empty($link_ext)) { ?>

                                        <a class="button" href="<?php echo $link_ext; ?>" target="_blank"><?php echo $link_text; ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                        <?php $i++; }
                                }
                            }
                            ?>

                        <?php endwhile;

                    endif;
                    ?>

                </div>

            </div>

        </div>

    </article>


<?php endif; ?>