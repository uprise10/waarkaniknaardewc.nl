<?php
// check current row layout
if( get_row_layout() == 'tekst_block_2_coloms' ):

    $text_col1 = get_sub_field('colom_1');
    $text_col2 = get_sub_field('colom_2');

    ?>

    <article class="block article_block full">
        <div class="inner">

            <div class="content article">

                <div class="col_2"><?php echo $text_col1; ?></div>
                <div class="col_2 last"><?php echo $text_col2; ?></div>

            </div>

        </div>
    </article>

<?php endif; ?>