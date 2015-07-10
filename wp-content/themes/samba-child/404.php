<?php
  get_header();
?>
<div id="centered_block" class="prk_inner_block columns centered main_no_sections">
  <div id="main_block" class="row">
      <div id="content">
        	<div id="main" class="main_no_sections prk_theme_page error_404">
          	<div class="single_page_title">
                <!-- <h1 class="header_font bd_headings_text_shadow zero_color huge">
                  404
                </h1> -->
       		  </div>
          	<div class="columns row twelve centered prk_centered_div posrel">
              <!-- <div class="simple_line thick header_divider three columns centered"></div> -->
              <div class="img-wr">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/404.jpg" alt="" class="full-404">
              </div>
              <div class="move-404">
                <h2>
                  <?php
                  echo $prk_translations['404_title_text'];
                  ?>
                </h2>
                <p class="big four_desc">
    				      <?php
                      echo $prk_translations['404_body_text'];
                  ?>
                </p>
                <div class="linksall">
                  <p>
                    <a href="<?php echo  get_home_url(); ?>" class="btn-404"><i class="fa fa-angle-left"></i> Home</a>
                  </p>
                  <p>
                    <a href="<?php  echo   get_site_url(); ?>/residential-properties/" class="btn-404"><i class="fa fa-angle-left"></i> Residential</a>
                  </p>
                  <p>
                    <a href="<?php  echo   get_site_url(); ?>/commercial-properties/" class="btn-404"><i class="fa fa-angle-left"></i> Commercial</a>
                  </p>
                </div>
              </div>
           	</div>
        	</div>
      </div>
  </div>
</div>
<?php get_footer(); ?>