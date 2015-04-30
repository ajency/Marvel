
 
define(['underscore', 'jquery', 'backbone', 'ProjectListMainView','jqueryui'],
		function( _ , $, Backbone, ProjectListView){


			//attach underscore string
        	//_.mixin(_.str.exports());
			
			/**
			 * 
			 */
			var PropertyListRouter = Backbone.Router.extend({

				initialize : function(){
					
					this.mainView = new ProjectListView();	

				},

				routes : {
					''	 			: 'index'
				
				},

				index : function(){
					console.log('Property list router index')
				},
				
				
				
				
			});	


			return PropertyListRouter;

		});