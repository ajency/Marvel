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
<!--        <script type="text/javascript" src="slider.js"></script>-->
        <script type="text/javascript">
            (function($) {
                $(document).ready(function() {
                  $('.faq_faq .arconix-faq-wrap .arconix-faq-title').each(function(i) {
                      $(this).prepend('<i class="faq_head_count">' + (i + 1) + '. </i>');
                  });
                  //gallery popup class adder
                  if ($('div').hasClass('gallery')) {
                      $('.gallery a.thumbnail').addClass('image-popup-no-margins');
                  }
                    if ($('div').hasClass('owl-carousel')) {
                        $('.owl-carousel .owl-item .item a').each(function() {
                            $(this).attr('href', $(this).find('img').attr('src'));
                        });
                        $('.owl-carousel .owl-item .item a').addClass('image-popup-no-margins');
                    }
              });
              $(window).load(function() {
                $('.child-footer').fadeIn('slow');
              });
              
            })( jQuery );
        </script>
    </body>
</html>