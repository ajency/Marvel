
 
/*define(['underscore', 'jquery', 'backbone', 'ProjectListMainView','jqueryui'],
		function( _ , $, Backbone, ProjectListView){*/


			//attach underscore string
        	//_.mixin(_.str.exports());
			
			/**
			 * 
			 */
			var PropertyListRouter = Backbone.Router.extend({

				initialize : function(){
					
					this.mainView = new ProjectListMainView();

                    console.log('reached project list router initializer');

				},

				routes : {
					''	 			: 'index'
				
				},

				index : function(){

					var searchOptionView = new searchOptionsView()
					

				}
				
				
				
				
			});	


			//return PropertyListRouter;
/*
		});

    */