<?php
// check current row layout
if( get_row_layout() == 'tekst_block_3_coloms' ):

    $text_col1 = get_sub_field('colom_1');
    $text_col2 = get_sub_field('colom_2');
    $text_col3 = get_sub_field('colom_3');
    ?>

    <article class="block article_block full">
        <div class="inner">

            <div class="content article">

                <div class="col_3"><?php echo $text_col1; ?></div>
                <div class="col_3"><?php echo $text_col2; ?></div>
                <div class="col_3 last"><?php echo $text_col3; ?></div>

            </div>

        </div>
    </article>

<?php endif; ?>