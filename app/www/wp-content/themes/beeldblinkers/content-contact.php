<?php
$colums_footer_adres_titel  = get_field('adres_titel', 'option');
$colums_footer_street       = get_field('straat_plus_huisnummer', 'option');
$colums_footer_zipcode      = get_field('postcode', 'option');
$colums_footer_city         = get_field('plaats', 'option');
$colums_footer_telephone    = get_field('telefoon', 'option');
$colums_footer_email        = get_field('email', 'option');
$colums_footer_twitter_url  = get_field('twitter_url', 'option');
$colums_footer_facebook_url = get_field('facebook_url', 'option');
$colums_footer_tumblr_url   = get_field('tumblr_url', 'option');
$colums_footer_linkedin_url = get_field('linkedin_url', 'option');

$contact_form = get_field('contactform_contact_pagina', 'option');

$tekst_footer_text = get_field('tekst_onder_logo', 'option');
?>

<article id="contact" class="block contact_block">
    <div class="inner">

        <div class="content">

            <div class="form">
                <div class="row">
                    <h2>Contactformulier</h2>
                    <?php echo do_shortcode($contact_form); ?>
                </div>
            </div>

            <div class="text">

                <div itemscope itemtype="http://schema.org/Organization">

                    <div class="row">

                        <h2>Waar kan ik naar de WC</h2>
                        <p><?php if(!empty($tekst_footer_text)) { echo $tekst_footer_text; } ?></p>

                    </div>

                    <div class="row">
                        <h2>Contactgegevens</h2>
                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <span itemprop="name"><?php if (!empty($colums_footer_adres_titel)) { echo $colums_footer_adres_titel; } ?></span><br>
                            <span itemprop="streetAddress"><?php if (!empty($colums_footer_street)) { echo $colums_footer_street; } ?></span><br>
                            <span itemprop="postalCode"><?php if (!empty($colums_footer_zipcode)) { echo $colums_footer_zipcode; } ?></span> <span itemprop="addressLocality"><?php if (!empty($colums_footer_city)) { echo $colums_footer_city; } ?></span>
                        </div>
                        <br>
                        <div class="content"><span itemprop="telephone"><?php if (!empty($colums_footer_telephone)) { echo $colums_footer_telephone; } ?></span></div>
                        <?php /* <div class="content"><span itemprop="email"><?php if (!empty($colums_footer_email)) { echo '<a href="mailto:' . $colums_footer_email . '">' . $colums_footer_email . '</a>'; } ?></span></div> */ ?>
                        <div class="content"><span itemprop="email"><?php if (!empty($colums_footer_email)) { echo $colums_footer_email; } ?></span></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</article>