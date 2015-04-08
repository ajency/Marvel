<?php
global $current_user;
get_currentuserinfo();
?>
<div class="wrap">
    <div id="icon-options-general" class="icon32 icon32-posts-post">
        <br/>
    </div>
    <h2><?php _e("Sola Testimonials Feedback","sola_t") ?></h2>

    <h3><?php _e("We'd love to hear your comments and/or suggestions","sola_st"); ?></h3>
    <form name="sola_t_feedback" action="" method="POST">
        <table width='100%'>
            <tr>
                <td width="250px" >
                    <label><?php _e("Your Name","sola_t"); ?></label>
                </td>
                <td>
                    <input type="text" class='sola-input' name="sola_t_feedback_name" value="<?php echo $current_user->user_firstname; ?>"/>
               </td>
            </tr>
            <tr>
                <td width="250px" >
                    <label><?php _e("Your Email","sola_t"); ?></label>
                </td>
                <td>
                    <input type="text" class='sola-input' name="sola_t_feedback_email" value="<?php echo $current_user->user_email; ?>"/>
               </td>
            </tr>
            <tr>
                <td width="250px" >
                    <label><?php _e("Your Website","sola_t"); ?></label>
                </td>
                <td>
                    <input type="text" class='sola-input' name="sola_t_feedback_website" value="<?php echo get_site_url(); ?>"/>
               </td>
            </tr>
            <tr>
                <td width="250px" valign='top' >
                    <label><?php _e("Feedback","sola_t"); ?></label>
                </td>
                <td>
                    <textarea name="sola_t_feedback_feedback" cols='60' rows='10'></textarea>
               </td>
            </tr>
            <tr>
                <td width="250px" valign='top' >
                </td>
                <td>
                    <input type='submit' name='sola_t_send_feedback' class='button-primary' value='<?php _e("Send Feedback","sola_t") ?>' />
               </td>
            </tr>
        </table>
    </form>
</div>