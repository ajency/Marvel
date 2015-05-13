
 
/*define(['underscore', 'jquery', 'backbone', 'ProjectListMainView','jqueryui'],
		function( _ , $, Backbone, ProjectListView){*/


			//attach underscore string
        	//_.mixin(_.str.exports());
			
			/**
			 * 
			 */
			var PropertyListRouter = Backbone.Router.extend({

				initialize : function(){
					
					

				},

				routes : {
					''	 					: 'index',
					  'compare/:id/:sid'	    : 'compare_properties',  
					 


				
				},

				index : function(){
					this.mainView = new ProjectListMainView();

                    console.log('reached project list router initializer');

					var searchOptionView = new searchOptionsView()
					

				},

				compare_properties : function(id,sid){

					console.log('compare_properties:------------'+id)
					console.log('compare_properties2:------------'+sid)

					if(id==0  || sid ==0 ){
						alert('Please select Two Properties for comparison')
					}
					else
						var propCompareView = new ProjectsCompareView({pid:id, psid:sid})
				}
				
				
				
				
			});	


			//return PropertyListRouter;
/*
		});

    */