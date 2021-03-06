<?php
/*
Template Name: Page - Floor Plans only
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

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/tabslider/styles/jquery.sliderTabs.min.css">
<style type="text/css">
    #headings_wrap {  /* display: none; */margin-bottom: 45px;}
    #main {margin-top: 0;}
    #prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block {
        margin-left: 0;
        margin-right: 0;
    }
</style>

<div id="centered_block" class="row">
    <div id="main_block" class="block_with_sections indi_prj_page floorplans columns centered prk_inner_block page-<?php echo get_the_ID(); ?>">
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

            <!--tabs-->
            <div class="vc_row">
                <div class="vc_column">


                    <!-- <div class="vc_custom_heading wpb_content_element m_t_b_m">
                        <h4 style="text-align: center;font-family:Montserrat;font-weight:400;font-style:normal">Residences</h4>
                    </div> -->

                    <div class="wpb_tabs wpb_content_element floorplans_tab" data-interval="0">
                        <div class="tabb y wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix ui-widget ui-widget-content ui-corner-all">
                            <ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                                <li><a href="#tab-siteplan" class="standout">SITE PLAN</a></li>
                                <li><a href="#tab-3bhk">4.5 BHK</a></li>
                                <li><a href="#tab-3_5bhk">3.5 BHK</a></li>
                                <!-- <li><a href="#tab-4_5bhk">4.5 BHK</a></li>
                                <li><a href="#tab-5_5bhk">5.5 BHK</a></li>
                                <li><a href="#tab-6_5bhk">6.5 BHK</a></li> -->
                            </ul>

                            <div id="tab-siteplan" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix ui-widget-content ui-corner-bottom">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Site Plan of Aeries
                                            <a class="wpb_button_a download_prj" title="Download" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Site-Plan.jpg" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Site-Plan.jpg" target="_self">
                                            <img width="700" height="561" src="http://marvel.ajency.in/wp-content/uploads/2015/05/Site-Plan.jpg" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-3bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide ui-widget-content vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_1"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="#ava_1"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="lay_1" class="inner-panels wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center current">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg" target="_self">
                                            <img width="700" height="561" src="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                                <div id="ava_1" class="inner-panels avatab wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <!-- <p>Availability content goes here</p> -->
                                        <div class="top_head">
                                            <div class="pull-left">
                                                <span class="box white_bg"></span>
                                                <span class="text">Available</span>
                                                <span class="box blue_bg"></span>
                                                <span class="text">Sold</span>
                                            </div>
                                            <div class="pull-right">
                                                <h6>Click on the available flat to request a hold.</h6>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="tabular_c" style="">
                                            <div class="left" style="display: none;">
                                                <i class="fa fa-chevron-left"></i>
                                            </div>
                                            <div class="right active" style="display: none;">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>

                                            <!-- table-testing -->
                                            <div class="clearfix"></div>
                                            <div class="table-cover">
                                                <div class="tabular_c" style="margin-top: 0; border-top: 0;">
                                                <div class="left">
                                                    <i class="fa fa-chevron-left"></i>
                                                </div>
                                                <div class="right active">
                                                    <i class="fa fa-chevron-right"></i>
                                                </div>
                                                <div class="table-holder">
                                                <div class="tabul_hold">
                                                    <table border="1">
                                                        <tr>
                                                            <th colspan="2">A-Flat No. (Sq.Ft.)</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="text_in"><span class="text_in">A 1001 (5,500)</span></span>
                                                                <!-- <div class="popup_tab_data">
                                                                    <div class="pull-left left_d">Flat Area</div>
                                                                    <div class="pull-left right_d">3,950</div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="pull-left left_d">Terrace Area</div>
                                                                    <div class="pull-left right_d">350</div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="pull-left left_d">Total Sellable Area</div>
                                                                    <div class="pull-left right_d">4,300</div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="btncol">
                                                                        <a class="wpb_button_a image-popup-no-margins" title="2D Layout" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg"><span class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                                                                        <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse" style="  padding: 7px 13px;">Request Hold</span></a>
                                                                    </div>
                                                                </div> -->
                                                            </td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td>A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                    </table>
                                                </div> <!-- /tabul_hold -->
                                                <div class="tabul_hold">
                                                    <table border="1">
                                                        <tr>
                                                            <th colspan="2">B-Flat No. (Sq.Ft.)</th>
                                                        </tr>
                                                        <tr>
                                                            <td>A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td>A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                    </table>
                                                </div> <!-- /tabul_hold -->
                                                <div class="tabul_hold">
                                                    <table border="1">
                                                        <tr>
                                                            <th colspan="2">C-Flat No. (Sq.Ft.)</th>
                                                        </tr>
                                                        <tr>
                                                            <td>A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td>A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                    </table>
                                                </div> <!-- /tabular_C -->
                                                <div class="tabul_hold">
                                                    <table border="1">
                                                        <tr>
                                                            <th colspan="2">D-Flat No. (Sq.Ft.)</th>
                                                        </tr>
                                                        <tr>
                                                            <td>A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td>A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="blue_bg">A 1001 (5,500)</td>
                                                            <td class="blue_bg">A 1002 (5,500)</td>
                                                        </tr>
                                                    </table>
                                                </div> <!-- /tabular_C -->
                                            </div> <!-- /table-holder -->
                                                </div> <!-- /tabula_c -->
                                            </div> <!-- /table-cover -->
                                            <!-- /table-testing -->

                                        </div>

                                        <div class="btm_foot">
                                            <p>
                                                Check availability in other unit types.
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse">4 BHK</span>
                                                </a>
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse">4.5 BHK</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-3_5bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide ui-widget-content vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_2"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="#ava_2"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="lay_2" class="inner-panels wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center current">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" target="_self">
                                            <img width="700" height="561" src="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                                <div id="ava_2" class="inner-panels avatab wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <div class="top_head">
                                            <div class="pull-left">
                                                <span class="box white_bg"></span>
                                                <span class="text">Available</span>
                                                <span class="box blue_bg"></span>
                                                <span class="text">Sold</span>
                                            </div>
                                            <div class="pull-right">
                                                <h6>Click on the available flat to request a hold.</h6>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="tabular_c">
                                            <div class="left"></div>
                                            <div class="right"></div>

                                            <div class="tabular">
                                                <div class="tab_row head">
                                                    <div class="tab_col">A-Flat No. (Sq.Ft.)</div>
                                                    <div class="tab_col">B-Flat No. (Sq.Ft.)</div>
                                                    <div class="tab_col">C-Flat No. (Sq.Ft.)</div>
                                                </div>
                                                <div class="tab_row">
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col opened">
                                                                    <span class="text_in"><span class="text_in">A 1001 (5,500)</span></span>
                                                                    <div class="popup_tab_data">
                                                                        <div class="pull-left left_d">Flat Area</div>
                                                                        <div class="pull-left right_d">3,950</div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="pull-left left_d">Terrace Area</div>
                                                                        <div class="pull-left right_d">350</div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="pull-left left_d">Total Sellable Area</div>
                                                                        <div class="pull-left right_d">4,300</div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="btncol">
                                                                            <a class="wpb_button_a image-popup-no-margins" title="2D Layout" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg"><span class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                                                                            <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse" style="  padding: 7px 13px;">Request Hold</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_row">
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_row">
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_row">
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_row">
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_row">
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_col">
                                                        <div class="tabular inner">
                                                            <div class="tab_row">
                                                                <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="btm_foot">
                                            <p>
                                                Check availability in other unit types.
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse">4 BHK</span>
                                                </a>
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse">4.5 BHK</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <!--  <div id="tab-4_5bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_2"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="#ava_2"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-5_5bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_2"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="#ava_2"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-6_5bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_2"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="#ava_2"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                            </div> -->

                            <div class="popup_tab_data">
                                <div class="pull-left left_d">Flat Area</div>
                                <div class="pull-left right_d">3,950</div>
                                <div class="clearfix"></div>
                                <div class="pull-left left_d">Terrace Area</div>
                                <div class="pull-left right_d">350</div>
                                <div class="clearfix"></div>
                                <div class="pull-left left_d">Total Sellable Area</div>
                                <div class="pull-left right_d">4,300</div>
                                <div class="clearfix"></div>
                                <div class="btncol">
                                    <a class="wpb_button_a image-popup-no-margins" title="2D Layout" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg"><span style="padding: 8px 13px; font-size: 13px;" class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                                    <a class="wpb_button_a" title="Availability" href="#"><span style="padding: 7px 13px; font-size: 13px;" class="wpb_button  wpb_btn-inverse" style="  padding: 7px 13px;">Request Hold</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="popup_tab_data">
                        <div class="pull-left left_d">Flat Area</div>
                        <div class="pull-left right_d">3,950</div>
                        <div class="clearfix"></div>
                        <div class="pull-left left_d">Terrace Area</div>
                        <div class="pull-left right_d">350</div>
                        <div class="clearfix"></div>
                        <div class="pull-left left_d">Total Sellable Area</div>
                        <div class="pull-left right_d">4,300</div>
                        <div class="clearfix"></div>
                        <div class="btncol">
                            <a class="wpb_button_a image-popup-no-margins" title="2D Layout" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg"><span style="padding: 8px 13px; font-size: 13px;" class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                            <a class="wpb_button_a" title="Availability" href="#"><span style="padding: 7px 13px; font-size: 13px;" class="wpb_button  wpb_btn-inverse" style="  padding: 7px 13px;">Request Hold</span></a>
                        </div>
                    </div> -->

                    <div class="go_to_top_inpage"></div>
                    <a class="enquiry_sideways">
                        <i></i>
                        Enquire Now
                    </a>
                    <div class="share_indi"></div>


                </div>
            </div>
            <!--/tabs end-->

        </div>
        <!--END project list styles-->
        <!--END project list styles-->
        <!--END project list styles-->

        <div class="clearfix"></div>
    </div><!-- /#main -->
</div><!-- /#content -->
</div><!-- #main_block -->
</div>

<!--
    <div id="np">
        <div class="spinner">
            <div class="spinner-icon" style="border-top-color: rgb(10, 194, 210); border-left-color: rgb(10, 194, 210);"></div>
        </div>
    </div>
-->

<script>
    var THEMEURL = '<?php echo get_parent_template_directory_uri(); ?>';
    var SITEURL = '<?php echo site_url(); ?>';
    var AJAXURL = '<?php echo admin_url('admin-ajax.php'); ?>';
        <?php /* var SITEDATA 	= <?php  $impruwSiteModel = new SiteModel(get_current_blog_id()); echo json_encode($impruwSiteModel->get_site_profile());  ?>;
        var USERDATA = <?php $impruwUserModel = new ImpruwUser(get_current_user_id());
        echo json_encode($impruwUserModel->get_user_basic_info()); */ ?>;
        var SITEID = {'id':<?php echo get_current_blog_id(); ?>}
        var UPLOADURL = '<?php echo admin_url('async-upload.php'); ?>';
        var _WPNONCE = '<?php echo wp_create_nonce('media-form'); ?>';
        var JSVERSION = '<?php echo JSVERSION; ?>';

    </script>

  <?php /*  <script
        data-main="<?php echo get_parent_template_directory_uri(); ?>/dev/js/init"
        src="<?php echo get_parent_template_directory_uri(); ?>/dev/js/require.js">

    </script> */ ?>





    <?php get_footer(); ?>

    <!--<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/tabslider/jquery.sliderTabs.min.js"></script>-->
    <script type="text/javascript">
        // var slider = jQuery("div.tabby").sliderTabs({
        //   mouseheel: false,
        //   //panelArrows: false,
        //   width: null,
        //   tabHeight: 43
        // });
    </script>