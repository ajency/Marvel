(function($) {
    jQuery(window).load(function() {

        function frmThemeOverride_frmAfterSubmit(e,f,b,a) {
            console.log('formidable form details:');
            console.log('a: ' + a);
            console.log('f: ' + f);
            console.log('e: ' + e);
            var formid = jQuery(a).find('input[name="form_id"]').val();
            console.log('id ' + formid);
            if(formid == 15){
                console.log('form ' + formid + ' has been submitted');
                afterformidablesubmit();
            }
        }
        function afterformidablesubmit() {
            loadingcontinforms();
        }

        function loadingcontinforms() {
            var countries = ["Your Country","Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas"
            ,"Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands"
            ,"Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica"
            ,"Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea"
            ,"Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana"
            ,"Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India"
            ,"Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia"
            ,"Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania"
            ,"Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia"
            ,"New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal"
            ,"Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles"
            ,"Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan"
            ,"Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia"
            ,"Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
            var htmlcount = '';
            for (var i = 0; i < countries.length; i++) {
                htmlcount += '<option value="'+ countries[i] +'">'+ countries[i] +'</option>';
            }
            if (jQuery('div').hasClass('hascountry-list')) {
                jQuery('.hascountry-list').find('select').each(function() {
                    jQuery(this).html(htmlcount)
                });
            }
            //trying out custom dropdowns
            // jQuery("#dd_locality").chosen({disable_search_threshold: 450});
            // jQuery("#dd_locality").change(function() {
            //     jQuery("#dd_locality").trigger('chosen:updated');
            // });
            //dropdown elipsis
            setTimeout(function() {
                jQuery('select').each(function() {
                    if (!(jQuery(this).prev('div').hasClass('elips-cont'))) {
                        jQuery(this).before('<div class="elips-cont"></div>');
                    }
                });

                jQuery('.elips-cont').each(function() {
                    jQuery(this).text(jQuery(this).next('select').find('option:selected').text());
                });
                jQuery('select').each(function() {
                    jQuery(this).change(function() {
                    //jQuery(this).prev('.elips-cont').text(jQuery("option:selected", this).text());
                    var cont = jQuery('.elips-cont').parent('div');

                    setTimeout(function() {
                        jQuery('.elips-cont').each(function() {
                            var par = jQuery(this).parent('div');
                            jQuery(this).text(par.find('select').find('option:selected').text());
                        });
                    }, 0.7);

                    });
                });
            }, 0.1);
        }
        var stuff = setInterval(function() {
            if (jQuery('.frm_message').is(':visible')) {
                setTimeout(function(){jQuery('.frm_message').hide('slow')}, 5000);
                clearInterval(stuff);
            } else {
            }
        }, 0.3);
        loadingcontinforms();
        jQuery(document).on('click', '.back_btn', function() {
            setTimeout(function() {
                loadingcontinforms();
            }, 50);
        });

    });
})( jQuery );