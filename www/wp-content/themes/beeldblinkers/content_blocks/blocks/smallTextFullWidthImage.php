<?php
// check current row layout
if( get_row_layout() == 'text_met_foto_volledige_breedte' ):

    $title = get_sub_field('titel');
    $text = get_sub_field('tekst');
    $background = get_sub_field('achtergrond');
    $link_type = get_sub_field('soort');
    $link = get_sub_field('link');
    $link_ext = get_sub_field('link_extern');

    ?>

<article class="block quote_fullwidth-img bg-green fullwidth">

    <div class="inner">

        <div class="content">

            <div class="text">

                <h1><?php echo $title; ?></h1>

                <?php echo $text; ?>

                <?php if ($link_type == 'intern') {
                    if (!empty($link)) { ?>

                        <a class="button" href="<?php echo $link; ?>">Lees het verhaal <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                    <?php }

                } else {

                    if (!empty($link_ext)) { ?>

                        <a class="button" href="<?php echo $link_ext; ?>" target="_blank">Lees het verhaal <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                <?php } } ?>

            </div>

        </div>
    </div>

    <div class="image">
        <img src="<?php echo $background['url']; ?>">
    </div>

</article>

<?php endif; ?>