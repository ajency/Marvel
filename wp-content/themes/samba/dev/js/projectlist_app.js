/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var _urlArg = "ver=" + (location.host === 'localhost' ? (new Date()).getTime() : JSVERSION); //to avoid file caching



function log(object){
    console.log(object);
}


/**
 * Returns the main application object instance
 * @return {[type]} [description]
 */
function getAppInstance(){

    return ProjectListApp;

}

/**
 * 
 * @param property
 */
function appHasProperty(property){
	
	var app = getAppInstance();
	
	return _.isUndefined(app[property]) !== true;
	
}







var __ = function(string){

    return pt.t(string)

}


 
        jQuery(document).ready(function(){



            Backbone.emulateHTTP = true;
            console.log('TEST');

            ProjectListApp = new Backbone.Marionette.Application();

            ProjectListApp.addRegions({
                searchSelectRegion: ".top-dd-c",
                comparePropertyRegion: ".top-compar",
                projectListingsRegion: '#proj_list'
            });



            getAppInstance().addInitializer(function(){

                getAppInstance().ViewManager = new Backbone.ChildViewContainer();


            });


            getAppInstance().addInitializer(function(){

                new PropertyListRouter();
                Backbone.history.start();

            });


            Backbone.Marionette.TemplateCache.prototype.loadTemplate = function ( templateId ) {
                var template = '',
                    url = THEMEURL + '/dev/js/templates/' + templateId ;

                // Load the template by fetching the URL content synchronously.
                Backbone.$.ajax( {
                    async   : false,
                    url     : url,
                    success : function ( templateHtml ) {
                        template = _.template(templateHtml,{d:'testing ...............'});
                    }
                } );

                return template;
            },
 
            getAppInstance().start();

         });





