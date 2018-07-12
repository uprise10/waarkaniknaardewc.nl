<?php
// check current row layout
if( get_row_layout() == 'tekst_block' ):

    $text = get_sub_field('tekst');
    ?>

    <article class="block article_block">
        <div class="inner">

            <div class="content article">

                <?php echo $text; ?>

            </div>

        </div>
    </article>

<?php endif; ?>