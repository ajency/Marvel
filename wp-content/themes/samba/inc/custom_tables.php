<?php 
//create tables of communication module

function create_address_tables(){
 
    global $wpdb;
    

    $table_name = $wpdb->prefix . "addresses";
    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name )
    {
        $table_create = "CREATE TABLE IF NOT EXISTS ".$table_name." (
                  id int(11) NOT NULL,
                  address varchar(50) NOT NULL,
                  city varchar(150) DEFAULT ' ',
                  region varchar(150) DEFAULT ' ',
                  postcode varchar(50) NOT NULL,
                  country varchar(50) DEFAULT ' ',
                  lat varchar(50) DEFAULT '',
                  lng varchar(50) DEFAULT '',
                  type enum('meeting','residential','office') NOT NULL,
                  private tinyint(1) NOT NULL,
                  addressable_id int(11) NOT NULL,
                  addressable_type varchar(30) NOT NULL,
                  notes text NOT NULL
                )" ; 
  
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($table_create);
    }
}


add_action('init','create_address_tables');

