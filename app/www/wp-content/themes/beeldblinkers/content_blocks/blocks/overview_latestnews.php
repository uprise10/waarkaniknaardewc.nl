<?php
// check current row layout
if( get_row_layout() == 'laatste_nieuws' ):

$aantal = get_sub_field('aantal');
$customSelection = get_sub_field('handmatige_selectie');
$selectedPostsObject = get_sub_field('selecteer_nieuwsberichten');

$button_active = get_sub_field('button_toevoegen');
$button_titel = get_sub_field('button_titel');
$button_link = get_sub_field('button_link');


$intro_title = get_sub_field('intro_titel');
if(empty($aantal)) {
    $aantal = 2;
    $count = 2;
} else {
    $count = $aantal;
}

// echo '<pre>';
// print_r($selectedPostsObject);
// echo '</pre>';

if( $customSelection && !empty($selectedPostsObject) ) {

    // get only first 3 results
    $ids = get_sub_field('selecteer_nieuwsberichten');
    $count = count($ids);

    $query = new WP_Query(
        array(
            'post_type'      	=> 'post',
            'posts_per_page'	=> 4,
            'post__in'			=> $ids,
            'post_status'		=> 'any',
            'orderby'        	=> 'post__in',
        )
    );
    $post_objects = $query->posts;

} else {
    // an array of post objects for the custom post type
    $query = new WP_Query(
        array(
            'post_type' => 'post',
            'posts_per_page' => $aantal
        )
    );
    $post_objects = $query->posts;
}
?>

<article id="nieuws" class="block nieuws">

    <div class="inner">
        <div class="content">

            <div class="intro">
                <h1 class="txt_color_orange"><?php echo $intro_title; ?></h1>
            </div>

            <div class="laatste-nieuws<?php if(!empty($count)) { echo ' item_count_' . $count; } ?>">

                <?php if( $post_objects ): ?>

                    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post);

                        // get acf fields related to each post
                        $short_description = get_field('korte_omschrijving');
                        ?>

                        <div class="item">
                            <div class="nieuws_info">
                                <p>Geplaatst op <?php echo get_the_date('d M Y'); ?></p>
                            </div>
                            <div class="item-wrap">
                                <figure class="item-wrap__image"><?php the_post_thumbnail( 'small' ); ?></figure>
                                <?php the_title('<h2>','</h2>'); ?>
                                <p><?php echo $short_description; ?></p>
                            </div>
                            <a class="leesmeer" href="<?php the_permalink(); ?>">Lees meer <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>

                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>

                <?php if($button_active && !empty($button_titel) && !empty($button_link)  ) {
                    echo '<div class="button_wrap"><a href="' . $button_link . '" class="button">' . $button_titel . ' <i class="fa fa-angle-right" aria-hidden="true"></i></a><div>';
                } ?>

            </div>
        </div>
    </div>
</article>

<?php endif; ?>