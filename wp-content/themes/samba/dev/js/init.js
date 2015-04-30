/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var _urlArg = "ver=" + (location.host === 'localhost' ? (new Date()).getTime() : JSVERSION); //to avoid file caching

/**
 * configure require
 *
 * @param {type} param
 */
require.config({
    urlArgs : _urlArg,
    baseUrl: THEMEURL + '/dev/js/',
    paths: {
        jquery      			: 'lib/jquery.min',
        jqueryui    			: 'lib/jquery.ui.min',
      //  bootstrap   			: 'lib/bootstrap.min',
     //   bootstrapselect 		: 'lib/bootstrapselect',
        underscore  			: 'lib/underscore.min',
        backbone    			: 'lib/backbone.min',
      //  text        			: 'lib/text',
      //  moment      			: 'lib/moment.min',
       /* cookie      			: 'lib/cookie.min',
        string      			: 'lib/underscore.string.min',
        checkbox    			: 'lib/flatui-checkbox',
        radio       			: 'lib/flatui-radio',*/
        marionette      		: 'lib/backbone.marionette.min',
       /* tpl                     : 'lib/tpl',
        json                    : 'lib/json',*/

        
        //Views
        ProjectListMainView				: 'views/ProjectListMainView',

        //Models
        residentialPropertymodel : 'models/residential-property',


        
    },
    waitSeconds: 15,
    shim: {



        'backbone': {
            deps: ['underscore', 'jquery'],
            exports: 'Backbone'
        },
        'underscore': {
            exports: '_'
        },
       /* 'string' : {
            deps : ['underscore']
        },

        'checkbox' :{
            deps : ['jquery']
        },
        'radio' :{
            deps : ['jquery']
        },
        'moment' : {
            deps : ['jquery'],
            exports : 'moment'
        },*/

        'jqueryui' : {
            deps : ['jquery']    
        },
       /* 'bootstrap' : {
            deps : ['jquery']    
        },
        'bootstrapselect' : {
            deps : ['jquery','bootstrap']
     
        },*/
        'marionette' : {
        	deps : ['backbone'],
        	exports : 'Marionette'
        }
        
    }
});

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


require(['backbone','marionette',
         'dev/js/routers/PropertyListRouter'],
         function( Backbone, Marionette, Router) {

        $(document).ready(function(){



            Backbone.emulateHTTP = true;
            alert('TEST');

            ProjectListApp = new Backbone.Marionette.Application();


            /*  getAppInstance().addInitializer(function(){

                getAppInstance().ViewManager = new Backbone.ChildViewContainer();


            });*/


            getAppInstance().addInitializer(function(){

                new Router();
                Backbone.history.start();

            });

            getAppInstance().start();

         });

});



