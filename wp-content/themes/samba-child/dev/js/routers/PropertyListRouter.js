
 
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
					'map' 					:'mapview' 
				
				},

				index : function(){ 
 

					if(_.isUndefined(getAppInstance().mainView)  || jQuery('#proj_list_main').length<=0 ){ 
						getAppInstance().mainView = new ProjectListMainView({mapview:false});
					 
					}
					else
						getAppInstance().mainView.mapview =false; 
                    

					var searchOptionView = new searchOptionsView()
					

				},

				compare_properties : function(id,sid){
					 
					if(id==0  || sid ==0 ){
						alert('Please select Two Properties for comparison')
					}
					else
						var propCompareView = new ProjectsCompareView({pid:id, psid:sid})
				},

				mapview : function(){

					 
					if(_.isUndefined(getAppInstance().mainView)  || jQuery('#proj_list_main').length<=0){
							getAppInstance().mainView = new ProjectListMainView({mapview:true});							 
					}
					else
						getAppInstance().mainView.mapview =true;

					var searchOptionView = new searchOptionsView()
					

				},
				
				
				
				
			});	


			//return PropertyListRouter;
/*
		});

    */