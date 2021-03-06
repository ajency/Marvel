
 
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
					''	 													: 'index',

					'compare/:id/:sid'	    								: 'compare_properties', 

					'map(/)(st/:pstatus)(/)(ct/:city)(/)(loc/:locality)(/)(type/:proptype)' :'mapview' ,					 

					'(/)(st/:pstatus)(/)(ct/:city)(/)(loc/:locality)(/)(type/:proptype)'	: "index" /* /#/ct/blore/loc/udmi/type/1BHK */

				
				},

				index : function(pstatus,city,locality,proptype){ 

		//alert('router'+pstatus)
					var options = [];

					if(!_.isUndefined(pstatus))
						options['pstatus'] = pstatus;

					if(!_.isUndefined(city))
						options['city'] = city;

					if(!_.isUndefined(locality))
						options['locality'] = locality;

					if(!_.isUndefined(proptype))
						options['type'] = proptype;

					options['post_type'] = 'residential-property';
					 
					/* if(_.isUndefined(queryMap) || _.isNull(queryMap)  || queryMap==false || queryMap==''){ 
					 	queryMap_vw = false ;					 	
					 }	
					 else{
					 	queryMap_vw = true ;	
					 }
					 options['mapview'] =  queryMap_vw;
					 alert(options['mapview'])
*/
					if(_.isUndefined(getAppInstance().mainView)  || jQuery('#proj_list_main').length<=0 ){ 
 	
						getAppInstance().mainView = new ProjectListMainView(options);
					 
					}
					else{

						getAppInstance().mainView.mapview =queryMap_vw; 
					}
                    

					var searchOptionView = new searchOptionsView(options)
					
					console.log('check options.....')
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

					options['post_type'] = 'residential-property';

  
					 
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