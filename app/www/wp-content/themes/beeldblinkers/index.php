<?php get_header(); ?>
    <main>
        <article id="nieuws" class="block nieuws_overzicht">
            <div class="inner">

                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="content">
                        <div class="nieuws_content acticle">
                            <div class="item">
                                <div class="nieuws_info">
                                    <p>Geplaatst op <?php echo get_the_date('d M Y'); ?></p>
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <figure class="nieuws_content__image"><?php the_post_thumbnail( 'small' ); ?></figure>

                                <?php if( ! empty( $short_description ) ) {
                                    echo $short_description;
                                } else {
                                    the_excerpt();
                                } ?>
                                <a class="leesmeer" href="<?php the_permalink(); ?>">Lees meer <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>


                         
               
                <?php endwhile; ?>
            

            
            </div>
        </article>
    </main>
<?php get_footer(); ?>