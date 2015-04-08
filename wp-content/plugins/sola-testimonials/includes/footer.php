<hr />
<div class="footer" style="padding:15px 7px;">
    <div id=foot-contents>
        <div class="support">
            <?php
                $support = '<a href="http://solaplugins.com/support-desk/" target="_BLANK">'.__('Support Desk', 'sola_t').'</a>';
                $contact = '<a href="http://solaplugins.com/contact-us/" target="_BLANK">'.__('Contact', 'sola_t').'</a>';
            ?>
            <p><?php _e('If you find any errors or if you have any suggestions, Get in contact with us via our '.$support.' or our '.$contact.' page', 'sola'); ?></p>
            <?php 
            $twitter_link = "<a href='https://twitter.com/solaplugins'>".__('Follow us on Twitter', 'sola_t')."</a>";
            if (function_exists("sola_t_register_pro")) { 
                global $sola_t_pro_version; 
                global $sola_t_pro_version_string; 
                ?>
                <p><?php _e('Sola Testimonials Premium Version: ', 'sola_t'); ?><a target='_BLANK' href="http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_version_premium"><?php echo $sola_t_pro_version." ".$sola_t_pro_version_string; ?></a> |
                <a target="_blank" href="http://solaplugins.com/support-desk/"><?php _e('Support', 'sola_t'); ?></a> | <?php echo $twitter_link; ?> </p>
                <?php } else { 
                    global $sola_t_version; global $sola_t_version_string; 
                    ?>
                    <p><?php _e('Sola Testimonials Version: ', 'sola_t'); ?><a target='_BLANK' href="http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_version_free"><?php echo $sola_t_version." ".$sola_t_version_string; ?></a> |
                    <a target="_blank" href="http://solaplugins.com/support-desk/"><?php _e('Support', 'sola_t'); ?></a> | 
                    <a target="_blank" id="upgrade" href="http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_footer" title="Premium Upgrade"><?php _e('Go Premium', 'sola_t'); ?></a> | <?php echo $twitter_link; ?> </p>
                <?php } ?>
        </div>
    </div>
</div>