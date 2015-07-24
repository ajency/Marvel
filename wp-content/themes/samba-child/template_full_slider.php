<?php
/*
Template Name: Page - Fullscreen Slider
*/
?>
<?php
  if (is_front_page()) {
    get_header('home');
  } else {
    get_header();
  }


  $data = get_post_meta( $post->ID, '_custom_meta_theme_page', true );
  $show_slider=true;
    if (isset($data['alchemy_autoplay']) && $data['alchemy_autoplay']!="")
      $autoplay="true";
    else
      $autoplay="false";
    if (isset($data['alchemy_full_delay']) && $data['alchemy_full_delay']!="")
      $delay=$data['alchemy_full_delay'];
    else
      $delay=$prk_samba_frontend_options['delay_portfolio'];
    if (isset($data['alchemy_hover']) && $data['alchemy_hover']!="")
      $hover_behave="false";
    else
      $hover_behave="true";
  $fill_height="super_height zero_shadow";
  $inside_filter="";
  $in_flag=false;
   if ($data!="") {
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
?>
<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/samba-child/dev/js/lib/underscore.min.js"></script>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery.ajax(ajax_var.url,{
                        type: 'GET',
                        action:'get_search_options',
                        data :{action:'get_search_options'},
                        complete: function() {

                        },
                        success: function(response) {

                           window.search_options  = response;
                           console.log('SEARCH OPTIONS')
                           console.log(window.search_options)



                           jQuery('.home_city').empty();

                           jQuery('.home_city').append('<option value="">City : All</option>')
                           jQuery('.home_city').append('<option class="select-dash" disabled="disabled">----------------------------------</option>')


                           var sorted_cities_options = [];

                           if(_.size(window.search_options.cities.cities)>0){
                                var sorted_cities_options  = _.sortBy(window.search_options.cities.cities, function(obj){ return obj.name.toLowerCase() });

                               _.each(sorted_cities_options,function(vl_cl,ky_cl){
                                    console.log(vl_cl);
                                    console.log('ky'+ky_cl)

                                     jQuery('.home_city').append('<option value="'+vl_cl.ID+'">'+vl_cl.name+'</option>')

                               })
                            }

                            

                           jQuery('.home_type').empty();
                           jQuery('.home_type').append('<option value="">Type : All</option>')
                           jQuery('.home_type').append('<option class="select-dash" disabled="disabled">----------------------------------</option>')
                           

                            var sorted_type_options = [];
                            if(_.size(window.search_options.type) > 0){
                              var sorted_type_options  = _.sortBy(window.search_options.type, function(obj){ return obj.property_unit_type.toLowerCase() });                           
            
                              for(var i=0;i<_.size(sorted_type_options);i++){

                                jQuery('.home_type').append('<option value="'+sorted_type_options[i].ID+'">'+sorted_type_options[i].property_unit_type+'</option>')

                              } 
                            }

                        },
                        error: function(){

                        },

                        dataType: 'json'
                    });

})




jQuery('.home_city').live('change',function(){
  jQuery('.home_location').empty();
  jQuery('.home_location').append('<option value="">Locality : All</option>');
  jQuery('.home_location').append('<option class="select-dash" disabled="disabled">----------------------------------</option>')

  console.log('window.search_options.locality.localities........')
  console.log(window.search_options.locality.localities)


  var sorted_locality_options = [];

  if(_.size(window.search_options.locality.localities)>0){

      var sorted_locality_options  = _.sortBy(window.search_options.locality.localities, function(obj){ return obj.name.toLowerCase() });               

      _.each(sorted_locality_options,function(vl_cl,ky_cl){
            console.log(vl_cl);
            console.log('ky'+ky_cl)
            if(jQuery('.home_city').val()==vl_cl.city_id){

                jQuery('.home_location').append('<option value="'+vl_cl.ID+'">'+vl_cl.name+'</option>')

            } 
       })
  }

})


jQuery('.home_btn_search_properties').live('click',function(evt){

  evt.preventDefault();
  var search_url = SITE_URL+'/residential-properties/#/st/Ongoing';
  //residential-properties/#/ct/blore/loc/mekri circle/type/1 BHK

  if(jQuery('.home_city').val()!=''){
    search_url= search_url + '/ct/'+jQuery('.home_city').val()
  }


  if(jQuery('.home_location').val()!=''){
    search_url= search_url + '/loc/'+jQuery('.home_location').val()
  }


   if(jQuery('.home_type').val()!=''){
    search_url= search_url + '/type/'+jQuery('.home_type').val()
  }


  window.location.href = search_url;


})






</script>

<div id="centered_block">
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <div id="content">
        <div id="main" role="main" class="main_with_sections">
            <?php
                if ($show_slider=="yes")
                {
                    echo do_shortcode('[prk_slider id="samba_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size="'.$fill_height.'" hover="'.$hover_behave.'"]');
                }
                ?>
            <div class="clearfix"></div>
            <div id="full_slider_page_content" class="prk_no_composer show_later">
              <?php
                while (have_posts()) : the_post();
                  the_content();
                endwhile;
              ?>
           <div class="clearfix"></div>
            </div>

            <div class="home_search adjustcenter">
              <div class="showin767">
                <input type="text" class="taptoview" placeholder="Find your home">
              </div>
              <div class="hidein767">
                <div class="hme_dd wc">
                  <select id="home_city"  class="home_city">
                    <option value="" >City : All</option>
                 <!--   <option value="Pune">Pune</option>
                    <option value="Bangalore">Bangalore</option> -->
                  </select>
                </div>
                <div class="hme_dd lo">
                  <select id="home_location"  class="home_location">
                    <option value="">Locality : All</option>
                  </select>
                </div>
                <div class="hme_dd ty">
                  <select id="home_type" class='home_type'>
                    <option value="Type">Type : All</option>
                  <!--  <option value="3_BHK">3 BHK</option> -->
                  </select>
                </div>
              </div>
              <div class="hme_dd lo btn">
                <button class="home_btn_sea home_btn_search_properties" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php
  if (is_front_page()) {
    get_footer('home');
  } else {
    get_footer();
  }
?>