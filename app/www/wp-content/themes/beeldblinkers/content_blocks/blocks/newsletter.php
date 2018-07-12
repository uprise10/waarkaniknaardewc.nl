<?php
// check current row layout
if( get_row_layout() == 'nieuwsbrief' ):

    $nieuwsbrief_title = get_field('nieuwsbrief_titel', 'option');
    $nieuwsbrief_text = get_field('nieuwsbrief_tekst', 'option');
    $nieuwsbrief_image = get_field('nieuwsbrief_foto', 'option');
    $nieuwsbrief_embed = get_field('nieuwsbrief_embed_html', 'option');   
    ?>

    <article id="doe-mee" class="block newsletter">

        <div class="inner">

            <div class="content">

                <?php if(!empty($nieuwsbrief_title)) { ?>
                    <h2><?php echo $nieuwsbrief_title; ?></h2>
                <?php } ?>

                <?php /* if(!empty($nieuwsbrief_title)) { ?>
                    <?php echo $nieuwsbrief_text; ?>
                <?php } 
                <iframe style="width: 100%; height: 1200px; border: 0;" src="https://www.mlds.nl/steunbetuiging/" scrolling="no"></iframe>
                 */ ?>

                <?php if(!empty($nieuwsbrief_embed)) { ?>
                    <?php echo $nieuwsbrief_embed; ?>
                <?php } ?>
                
            </div>

        </div>

    </article>

<?php endif; ?>