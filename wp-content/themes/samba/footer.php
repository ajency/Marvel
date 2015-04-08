                    <?php 
                        global $prk_samba_frontend_options;
                        global $resp_class
                    ?>
                </div><!-- /#prk_ajax_container -->
                </div><!-- /#wrap -->
            <div class="push"></div>
        </div><!-- #ultra_wrapper -->
        <div class="clearfix"></div>
        <!--googleoff: all-->
        <div class="prk_meta">
            <div class="prk_page_ttl"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
            <div class="prk_body_classes"><?php body_class('samba_theme'.$resp_class); ?></div>
        </div>
        <!--googleon: all-->
        <?php echo $prk_samba_frontend_options['ganalytics_text']; ?>
        <?php wp_footer(); ?>
    </body>
</html>