<?php
$nieuwsbrief_title = get_field('nieuwsbrief_titel', 'option');
$nieuwsbrief_text = get_field('nieuwsbrief_tekst', 'option');
$nieuwsbrief_image = get_field('nieuwsbrief_foto', 'option');
?>

<article id="doe-mee" class="block newsletter">

    <div class="inner">

        <div class="content">

            <?php if(!empty($nieuwsbrief_title)) { ?>
                <h2><?php echo $nieuwsbrief_title; ?></h2>
            <?php } ?>

            <?php if(!empty($nieuwsbrief_title)) { ?>
                <?php echo $nieuwsbrief_text; ?>
            <?php } ?>

        </div>

    </div>

</article>