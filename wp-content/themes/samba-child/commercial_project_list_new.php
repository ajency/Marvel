<?php
/*
Template Name: Page - Commercial Projects List New
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
            <div class="right_container"></div>
            
            <!--END project list styles-->
            <!--END project list styles-->
            <!--END project list styles-->
            
            <div class="clearfix"></div>
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
</div>

<div id="mapspan"></div>       

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

    </script>
*/ ?>
 

<?php 
require_once(ABSPATH."/wp-content/themes/samba-child/modules/commonJs.php") ;
require_once(ABSPATH."/wp-content/themes/samba-child/modules/projectList/commercialprojectlistJS.php") ?>
<script type="text/javascript" src = "<?php echo site_url(); ?>/wp-content/themes/samba-child/dev/js/commercial-projectlist_app.js"></script>



<?php get_footer(); ?>