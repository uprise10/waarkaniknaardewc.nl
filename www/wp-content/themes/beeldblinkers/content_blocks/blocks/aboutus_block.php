<?php
// check current row layout
if( get_row_layout() == 'over_ons' ):

    $title = get_sub_field('titel');
    $text = get_sub_field('tekst');
    $background = get_sub_field('achtergrond');
    $link_type = get_sub_field('soort');
    $link_ext = get_sub_field('link_extern');
    $link = get_sub_field('link');
    ?>
<article id="over-ons" class="block quote_fullwidth-img">

    <div class="inner">

        <div class="content">

            <div class="text">

                <h2><?php echo $title; ?></h2>

                <?php echo $text; ?>

                <?php if ($link_type == 'intern') { ?>

                    <a class="button green_trans" href="<?php echo $link; ?>">Lees het verhaal <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                <?php } else { ?>

                    <a class="button green_trans" href="<?php echo $link_ext; ?>" target="_blank">Lees het verhaal <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                <?php } ?>

            </div>

            <div class="image">
                <img src="<?php echo $background['sizes']['quote-bg']; ?>" width="<?php echo $background['sizes']['quote-bg-width']; ?>" height="<?php echo $background['sizes']['quote-bg-height']; ?>">
            </div>

        </div>
    </div>
</article>

<?php endif; ?>