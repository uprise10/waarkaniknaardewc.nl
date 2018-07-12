<?php
// if(!is_front_page()) {
//     get_template_part('content', 'newsletter');
// }
// get_template_part('content', 'contact');

/*
$tekst_footer_logo = get_field('logo', 'option');

$footer_logo_1 = get_field('footer_logo_1', 'option');
$logo_1_url = get_field('logo_1_link', 'option');
$footer_logo_2 = get_field('footer_logo_2', 'option');
$logo_2_url = get_field('logo_2_link', 'option');
$footer_logo_3 = get_field('footer_logo_3', 'option');
$logo_3_url = get_field('logo_3_link', 'option');
?>

<footer class="block footer_block text_center">

    <div class="inner">
        <div class="content">


            <?php if(!empty($footer_logo_1 && $logo_1_url || $footer_logo_2 && $logo_2_url || $footer_logo_3 && $logo_3_url)) { ?>

                <div class="footer_logos">
                    <?php if(!empty($footer_logo_1 && $logo_1_url)) { ?>
                        <a href="<?php echo  $logo_1_url; ?>" target="_blank">
                            <img src="<?php echo $footer_logo_1['url']; ?>">
                        </a>
                    <?php } ?>
                    <?php if(!empty($footer_logo_2 && $logo_2_url)) { ?>
                        <a href="<?php echo  $logo_2_url; ?>" target="_blank">
                            <img src="<?php echo $footer_logo_2['url']; ?>">
                        </a>
                    <?php } ?>
                    <?php if(!empty($footer_logo_3 && $logo_3_url)) { ?>
                        <a href="<?php echo  $logo_3_url; ?>" target="_blank">
                            <img src="<?php echo $footer_logo_3['url']; ?>">
                        </a>
                    <?php } ?>
                </div>

            <?php } ?>

            &copy; <?php echo date("Y"); ?> Waar kan ik naar de WC

        </div>
    </div>

</footer>

*/ ?>

<?php wp_footer(); ?>

<script>
    // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    //         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    //     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    // ga('create', 'xxxxxxx', 'auto');
    // ga('send', 'pageview');
</script>
</body>
</html>
