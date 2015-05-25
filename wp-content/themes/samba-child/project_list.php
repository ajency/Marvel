<?php
/*
Template Name: Page - Resi Projects List
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
    <div id="main_block" class="block_with_sections mapView page-<?php echo get_the_ID(); ?>">
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

            <!--these are the project list styles-->
            <!--these are the project list styles-->
            <!--these are the project list styles-->
            <div class="proj_list">
                <div class="top-dd-c">
                    <div class="top-dd one">
                        <select id="dd_status">
                            <option>Ongoing</option>
                            <option>Upcoming</option>
                        </select>
                    </div>
                    <div class="top-dd two">
                        <select id="dd_city">
                            <option>Pune</option>
                        </select>
                    </div>
                    <div class="top-dd thr">
                        <select id="dd_locality" disabled>
                            <option>Locality</option>
                        </select>
                    </div>
                    <div class="top-dd fou">
                        <select id="dd_type" disabled>
                            <option>Type</option>
                        </select>
                    </div>
                    <div class="top-sea">
                        <button type="submit" class="btn_norm sea"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="pull-right top-view">
                        <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
                        <a href="#" class="top_map"><i class="fa fa-map-marker"></i></a>
                    </div>
                </div>

                <div class="top-compar">
                    <div class="drag_area one after_drag">
                        <div class="before_drag">
                            Drag for Comparision
                        </div>
                        <div class="after_drag_content">
                            <p class="dragged_title">
                                <span class="single_p_title">Marvel Edge</span><br>
                                <span class="single_p_location">Viman Nagar</span>
                            </p>
                        </div>
                    </div>
                    <div class="drag_area two">
                        <div class="before_drag">
                            Drag for Comparision
                        </div>
                        <div class="after_drag_content">
                            <p class="dragged_title">
                                <span class="single_p_title">Marvel Edge</span><br>
                                <span class="single_p_location">Viman Nagar</span>
                            </p>
                        </div>
                    </div>
                    <a href="#" class="btn_norm top_btn_co disabled">Compare</a>
                </div>

                <div id="proj_list" class="project-list row">
                    <div class="twelve columns">
                        <h5>Commercial Projects in Pune</h5>
                    </div>
                    <!--single project listing-->
                    <div class="single_p_w six columns">
                        <div class="single_p_img">
                            <img src="http://loremflickr.com/1000/1000/building">
                            <div class="compare">
                                <a href="#" class="comp_ico"></a>
                            </div>
                            <div class="single_p_hov_c">
                                <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                                <div class="clearfix"></div>
                                <div class="single_p_info">
                                    <h6>Office Spaces: 1200 - 50,000 sq. ft.</h6>
                                    <h6>Retail Spaces: 500 - 1,400 sq. ft.</h6>
                                </div>
                                <div class="single_btm">
                                    <div class="pull-left">
                                        <a href="#" class="btn_norm single_enq"><i class="fa fa-envelope-o"></i></a>
                                        <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn_norm single_know">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_p_cap">
                            <p class="single_p_inf">
                                <a href="#">
                                    <span class="single_p_title">Marvel Edge</span>
                                    <span class="single_p_light">|</span>
                                    <span class="single_p_location">Viman Nagar</span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <!--END single project listing-->
                </div>
            </div>

            <div id="projects_listings">
                <div class="map_info_c">
                 <div class="img_cont">
                    <a href="#" class="img_link">
                        <img src="http://loremflickr.com/1000/1000/building" alt="" class="pull-left map_fi">
                    </a>
                </div>
                <div class="map_info">
                    <a href="#" class="map_p_title">
                        <span class="single_p_title">Marvel Edge</span>
                        <span class="single_p_light">|</span>
                        <span class="single_p_location">Viman Nagar</span>
                    </a>
                    <p class="map_excerpt">
                        3.5, 4BHK Apartments, Duplexes and Penthouses
                    </p>
                    <p class="map_p_cost">
                        INR 2.2 CR +
                    </p>
                    <div class="map_btm">
                        <div class="pull-left">
                            <a href="#" class="btn_norm single_enq"><i class="fa fa-envelope-o"></i></a>
                            <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a>
                            <a href="#" class="btn_norm single_compare"></a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn_norm single_know">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--tabs-->
            <div class="vc_row">
                <div class="vc_column indi_prj_page columns centered prk_inner_block">

                    <div class="wpb_tabs wpb_content_element" data-interval="0">
                        <div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">
                            <ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix">
                                <li><a href="#tab-siteplan" class="standout">Siteplan</a></li>
                                <li><a href="#tab-3bhk">3 BHK</a></li>
                                <li><a href="#tab-3_5bhk">3.5 BHK</a></li>
                            </ul>

                            <div id="tab-siteplan" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Siteplan of Project Name
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a href="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" target="_self">
                                            <img width="700" height="561" src="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div id="tab-3bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a" title="2D Layout" href="#"><span class="wpb_button  wpb_btn-inverse wpb_btn-small tog white">2D Layout</span></a>
                                            <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse wpb_btn-small tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="layout_tab1" class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a href="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" target="_self">
                                            <img width="700" height="561" src="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                                <div id="availability_tab1" class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
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
                                                                            <a class="wpb_button_a" title="2D Layout" href="#"><span class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                                                                            <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse wpb_btn-small">Request Hold</span></a>
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
                                                Check availability in other Unit Types.
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse wpb_btn-small">4 BHK</span>
                                                </a>
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse wpb_btn-small">4.5 BHK</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-3_5bhk" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a 3 BHK &#8211; 3700 sq. ft to 5000 sq. ft.
                                            <a class="wpb_button_a download_prj" title="Download" href="#">
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a" title="2D Layout" href="#"><span class="wpb_button  wpb_btn-inverse wpb_btn-small tog white">2D Layout</span></a>
                                            <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse wpb_btn-small tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="layout_tab1" class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a href="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" target="_self">
                                            <img width="700" height="561" src="http://marvel.ajency.in/wp-content/uploads/2015/04/layout.png" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                                <div id="availability_tab1" class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
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
                                                                            <a class="wpb_button_a" title="2D Layout" href="#"><span class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                                                                            <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse wpb_btn-small">Request Hold</span></a>
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
                                                Check availability in other Unit Types.
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse wpb_btn-small">4 BHK</span>
                                                </a>
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse wpb_btn-small">4.5 BHK</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

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