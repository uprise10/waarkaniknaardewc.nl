<?php
if( get_row_layout() == 'logos' ):
    $title = get_sub_field('titel');
    $logos = get_sub_field('logos'); ?>
    <article class="block logo_block">
        <div class="inner">
            <div class="content">
                <div class="intro">
                    <h2><?php echo $title; ?></h2>
                </div>
                <?php
                // check if the nested repeater field has rows of data
                if( have_rows('logos') ):
                    // loop through the rows of data
                    while ( have_rows('logos') ) : the_row();
                        $foto = get_sub_field('logo_afbeelding');
                        $link = get_sub_field('link');
                        if (!empty($link)) {
                            if (!empty($foto)) {
                                echo '<div class="logo-item"><a href="' . $link . '"><img src="' . $foto['url'] . '"></a></div>';
                            }
                        } else {
                            if (!empty($foto)) {
                                echo '<div class="logo-item"><img src="' . $foto['url'] . '"></div>';
                            }
                        }
                    endwhile;
                endif; ?>
            </div>
        </div>
    </article>
<?php endif; ?>