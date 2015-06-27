<?php

function registerListingMenu() {
  global $plist_admin_page;
  $plist_admin_page = add_menu_page('Rent-Resale List', 'Rent-Resale List', 'manage_options', 'rent-resale-list', 'propertyListing', '', 30);
 }

add_action('init', 'registerListingMenu');



function propertyListing(){
    include('rent-resale-list.php');
}

