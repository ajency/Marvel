<?php
/*
Template Name: Page - Compare View
*/
?>
<?php 
  get_header(); 
  $show_sidebar=$prk_samba_frontend_options['right_sidebar'];
  if ($show_sidebar=="yes")
    $show_sidebar=true;
  else
    $show_sidebar=false;
  $data = get_post_meta( $post->ID, '_custom_meta_theme_page', true );
  $show_title=true;
  $show_slider=false;
  if (!empty($data))
  {
    if (isset($data['alchemy_show_sidebar']) && $data['alchemy_show_sidebar']=="yes") {
      $show_sidebar=true;
    }
    if (isset($data['alchemy_show_sidebar']) && $data['alchemy_show_sidebar']=="no") {
      $show_sidebar=false;
    }
    if (isset($data['alchemy_show_title']) && $data['alchemy_show_title']=="yes") {
        $show_title=false;
    }
    if (isset($data['alchemy_featured_slide'])) {
        $show_slider=$data['alchemy_featured_slide'];
    }
    if (isset($data['alchemy_full_slide']) && $data['alchemy_full_slide']!="")
      $autoplay="true";
    else
      $autoplay="false";
    if (isset($data['alchemy_full_delay']) && $data['alchemy_full_delay']!="")
      $delay=$data['alchemy_full_delay'];
    else
      $delay=$prk_samba_frontend_options['delay_portfolio'];
    $inside_filter="";
    $in_flag=false;
    foreach ($data as $childs)
    {
      //ADD THE CATEGORIES TO THE FILTER
      if ($in_flag==true)
      { 
        $inside_filter.=$childs.", ";
      }
      if ($childs=='weirdostf')
        $in_flag=true;
    }
    }
  //NEVER SHOW SIDEBAR
  $show_sidebar=false;
?>
<div id="centered_block" class="row">
<div id="main_block" class="block_with_sections compare page-<?php echo get_the_ID(); ?>">
    <?php
      echo prk_output_featured_image(get_the_ID());
      if ($show_title==true)
      {
          prk_output_title($data);
          $extra_class=" with_title";
      }
      else
      {
        $extra_class="";
      }
    ?>
    <div id="content">
        <div id="main" role="main" class="main_with_sections<?php echo $extra_class; ?>">
            
            <!--these are the Compare styles-->
            <!--these are the Compare styles-->
            <!--these are the Compare styles-->
            <div class="compare_c">
                <div class="top-dd-c info_bar">                    
                    <a href="#" class="wpb_button back_btn"><i class="fa fa-angle-left"></i> Back to Residential</a>
                    <p>
                        You are comparing between
                        <a href="#" class="comp_n">Marvel Kyra</a>
                        and
                        <a href="#" class="comp_n">Marvel Izara</a>
                    </p>
                </div>
                    <!--start here next-->
                    <div class="compare_i_c">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th></th>
                                <th class="with_img">
                                    <img src="http://loremflickr.com/1000/450/cat" alt="" class="compare_fi">
                                    <p class="single_p_inf">
                                        <a href="#">
                                            <span class="single_p_title">Marvel Edge</span>
                                            <span class="single_p_light">|</span>
                                            <span class="single_p_location">Viman Nagar</span>
                                        </a>
                                    </p>
                                </th>
                                <th class="with_img">
                                    <img src="http://loremflickr.com/1000/450/cat" alt="" class="compare_fi">
                                    <p class="single_p_inf">
                                        <a href="#">
                                            <span class="single_p_title">Marvel Izara</span>
                                            <span class="single_p_light">|</span>
                                            <span class="single_p_location">Magarpatta Road</span>
                                        </a>
                                    </p>
                                </th>
                            </tr>
                            
                            <tr class="head-row">
                                <td colspan="3">Residences</td>
                            </tr>
                            <tr>
                                <td>Types</td>
                                <td>4, 4.5 BHK, duplexes, penthouses</td>
                                <td>4, 4.5 BHK, duplexes, penthouses</td>
                            </tr>
                            <tr>
                                <td>Sellable Area</td>
                                <td>3,500 to 5,000 SQ. FT.</td>
                                <td>4,000 to 5,500 SQ. FT.</td>
                            </tr>
                            
                            <tr class="head-row">
                                <td colspan="3">Amenities</td>
                            </tr>
                            <tr>
                                <td>Private Swimming Pool</td>
                                <td><span class="yes"></span></td>
                                <td><span class="no">-</span></td>
                            </tr>
                            <tr>
                                <td>Private Garden</td>
                                <td><span class="yes"></span></td>
                                <td><span class="yes"></span></td>
                            </tr>
                            
                            <tr class="head-row darker-bg">
                                <td colspan="3">Neighbourhood</td>
                            </tr>
                            <tr>
                                <td class="da">School</td>
                                <td>2 KM</td>
                                <td>0.4 KM</td>
                            </tr>
                            <tr>
                                <td class="da">Hospital</td>
                                <td>2.5 KM</td>
                                <td>4 KM</td>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="compare_f full-width">
                        <p class="foot_head">Looking for Help?</p>
                        <p>Its very easy to get overwhelmed with the unique propositions of Marvel properties. Let us help you in making up your mmind.</p>
                        <a href="#" class="wpb_button">Give Details</a>
                    </div>
            </div>
            <!--END Compare styles-->
            <!--END Compare styles-->
            <!--END Compare styles-->
            
            <div class="clearfix"></div>
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
</div>
<?php get_footer(); ?>