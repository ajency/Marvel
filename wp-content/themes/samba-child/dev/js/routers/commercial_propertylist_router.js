
 
/*define(['underscore', 'jquery', 'backbone', 'ProjectListMainView','jqueryui'],
		function( _ , $, Backbone, ProjectListView){*/


			//attach underscore string
        	//_.mixin(_.str.exports());
			
			/**
			 * 
			 */
			var commercial_propertylist_router = Backbone.Router.extend({

				initialize : function(){ 

				},

				routes : {
					''	 													: 'index',

					'compare/:id/:sid'	    								: 'compare_properties', 

					'map(/)(st/:pstatus)(/)(ct/:city)(/)(loc/:locality)(/)(type/:proptype)' :'mapview' ,					 

					'(/)(st/:pstatus)(/)(ct/:city)(/)(loc/:locality)(/)(type/:proptype)'	: "index" /* /#/ct/blore/loc/udmi/type/1BHK */

				
				},

				index : function(pstatus,city,locality,proptype){ 

		
					var options = [];

					if(!_.isUndefined(pstatus))
						options['pstatus'] = pstatus;

					if(!_.isUndefined(city))
						options['city'] = city;

					if(!_.isUndefined(locality))
						options['locality'] = locality;

					if(!_.isUndefined(proptype))
						options['type'] = proptype;

					 
					options['post_type'] = 'commercial-property'; 
 

					if(_.isUndefined(getAppInstance().mainView)  || jQuery('#proj_list_main').length<=0 ){ 

						options['mapview'] =  false;
						getAppInstance().mainView = new ProjectListMainView(options);
					 
					}
					else{

						getAppInstance().mainView.mapview =false; 
					}
                    

					var searchOptionView = new searchOptionsView(options)
					
					console.log('ROUTER check options.........')
					console.log(options)

				},

				compare_properties : function(id,sid){
					 
					if(id==0  || sid ==0 ){
						alert('Please select Two Properties for comparison')
					}
					else
						var propCompareView = new ProjectsCompareView({pid:id, psid:sid})
				},

				mapview : function(pstatus,city,locality,proptype){

					var options = [];

					if(!_.isUndefined(pstatus))
						options['pstatus'] = pstatus;

					if(!_.isUndefined(city))
						options['city'] = city;

					if(!_.isUndefined(locality))
						options['locality'] = locality;

					if(!_.isUndefined(proptype))
						options['type'] = proptype;

					options['post_type'] = 'commercial-property' 
					 
					if(_.isUndefined(getAppInstance().mainView)  || jQuery('#proj_list_main').length<=0){

							options['mapview'] =  true;
							getAppInstance().mainView = new ProjectListMainView(options);							 
					}
					else
						getAppInstance().mainView.mapview =true;


					console.log('mapview ROUTER OPtioNS :- ')
					console.log(options); 

					var searchOptionView = new searchOptionsView(options)
					

				},
				
				
				
				
			});	


			//return PropertyListRouter;
/*
		});

    */