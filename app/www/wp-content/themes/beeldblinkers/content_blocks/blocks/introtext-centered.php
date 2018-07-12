<?php
// check current row layout
if( get_row_layout() == 'intro_gecentreerde_tekst' ):

    $text = get_sub_field('tekst'); ?>

    <article class="block text_center">

        <div class="inner">
            <div class="content">

                <?php echo $text; ?>

            </div>
        </div>
    </article>

<?php endif; ?>


