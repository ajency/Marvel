jQuery(document).ready(function() {

    jQuery.validate({
        form: "#sola_t_submit_testimonial"}
    );

    jQuery(".sola_t_image").imgLiquid({
        fill: true,
        horizontalAlign: "center",
        verticalAlign: "top"
    });

    jQuery('.sola_t_layout_1_container .sola_t_container, .sola_t_layout_2_container .sola_t_container, .sola_t_layout_3_container .sola_t_container, .sola_t_layout_4_container .sola_t_container').matchHeight();

});