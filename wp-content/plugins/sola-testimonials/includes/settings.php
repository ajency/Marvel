<div class="wrap">    
    <div class="sola_t_header">
        <div class="sola_t_header_text">            
            <h2><?php _e('Sola Testimonials - Settings', 'sola_t'); ?></h2>
            <small><div class="help-block"><?php _e('Please ensure you have saved any changes before navigating to another tab', 'sola_t'); ?></div></small>
        </div>
    </div>
    <div class="sola_settings_body">
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 'styles' || !isset($_GET['tab'])) { echo 'nav-tab-active'; } ?>" href="?post_type=testimonials&page=sola_t_settings&tab=styles"><?php _e('Styles', 'sola_t'); ?></a>
            <a class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 'shortcodes') { echo 'nav-tab-active'; } ?>" href="?post_type=testimonials&page=sola_t_settings&tab=shortcodes"><?php _e('Shortcodes', 'sola_t'); ?></a>
            <a class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 'options') { echo 'nav-tab-active'; } ?>" href="?post_type=testimonials&page=sola_t_settings&tab=options"><?php _e('Options', 'sola_t'); ?></a>
            <a class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 'forms') { echo 'nav-tab-active'; } ?>" href="?post_type=testimonials&page=sola_t_settings&tab=forms"><?php _e('Form Options', 'sola_t'); ?></a>
            <a class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 'slider') { echo 'nav-tab-active'; } ?>" href="?post_type=testimonials&page=sola_t_settings&tab=slider"><?php _e('Slider', 'sola_t'); ?></a>
            <?php if (!function_exists('sola_t_register_pro')){ ?>
                <a class="nav-tab <?php if(isset($_GET['tab']) && $_GET['tab'] == 'upgrade') { echo 'nav-tab-active'; } ?>" href="?post_type=testimonials&page=sola_t_settings&tab=upgrade"><?php _e('Upgrade', 'sola_t'); ?></a>
            <?php } ?>
        </h2>
        <?php
        if(isset($_GET['tab'])){
            $tab = $_GET['tab'];
        } else {
            $tab = '';
        }
        echo '<table class="form-table">';
        switch ($tab){
            case 'options':
                include 'settings/options.php';
                break;
            case 'forms':
                include 'settings/forms.php';
                break;
            case 'shortcodes':
                include 'settings/shortcodes.php';
                break;
            case 'slider':
                include 'settings/slider.php';
                break;
            case 'upgrade':
                include 'settings/upgrade.php';
                break;
            default:
                include 'settings/styles.php';
                break;
        }
        echo '</table>';
        include 'footer.php';
        ?>
    </div>
</div>




