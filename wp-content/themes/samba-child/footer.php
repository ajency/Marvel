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
        <div class="child-footer">
            <!--widget area-->
            <?php
                    if ($prk_samba_frontend_options['bottom_sidebar']=="yes")
                    {
                        ?>
                          <div id="footer_in">
                              <?php
                                  if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) :
                                  endif;
                              ?>
                              <div class="clearfix"></div>
                          </div>
                        <?php
                    }
                    if ($prk_samba_frontend_options['footer_text']!="")
                    {
                      ?>
                      <!-- <div id="after_widgets">
                        <div id="copy" class="twelve columns">
                            <?php //echo $prk_samba_frontend_options['footer_text']; ?>
                        </div>
                        <div id="back_to_top">
                            <div class="navicon-arrow-up-2">
                            </div>
                        </div>
                          <div class="clearfix"></div>
                      </div> -->
                      <?php
                    }
                  ?>
        </div>
        <!--googleon: all-->
        <?php echo $prk_samba_frontend_options['ganalytics_text']; ?>
        <?php wp_footer(); ?>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/slider.js"></script>
    </body>
</html>