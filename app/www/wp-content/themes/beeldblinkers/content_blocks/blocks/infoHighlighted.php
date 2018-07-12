<?php
// check current row layout
if( get_row_layout() == 'info_uitgelicht' ):

$title = get_sub_field('titel');
$text = get_sub_field('tekst');
$link_title = get_sub_field('link_tekst');
$image = get_sub_field('foto');

$link_type = get_sub_field('soort');
$link_ext = get_sub_field('link_extern');
$link = get_sub_field('link_url');
?>

<article class="block info_block">
    <div class="inner">

        <div class="content">

            <div class="text">
                <h2><?php echo $title; ?></h2>
                <?php echo $text; ?>

                <?php if ($link_type == 'intern') { ?>

                    <a href="<?php echo $link; ?>" class="button green"><?php echo $link_title; ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                <?php } else { ?>

                    <a class="button green" href="<?php echo $link_ext; ?>" target="_blank"><?php echo $link_title; ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                <?php } ?>

            </div>
            <div class="image">
                <img class="img-contain" src="<?php echo $image['sizes']['infoblock']; ?>" width="<?php echo $image['sizes']['infoblock-width']; ?>" height="<?php echo $image['sizes']['infoblock-height']; ?>">
            </div>

        </div>

    </div>
</article>

<?php endif; ?>