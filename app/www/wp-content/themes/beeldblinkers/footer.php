<footer class="block footer footer_block text_center">

    <div class="inner">
        <div class="content">
            <div class="column">
                <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
            </div>
            <div class="column">
	            <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
            </div>

            <div class="copyright">&copy; <?php echo date("Y"); ?> Waar kan ik naar de WC</div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
