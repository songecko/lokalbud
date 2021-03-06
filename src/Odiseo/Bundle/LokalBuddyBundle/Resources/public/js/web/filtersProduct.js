Hydra.module.register('town-filter-module', function(Bus, Module, ErrorHandler, Api){
	return {
		oModuleContainer : null,
		selectorItemFilter : null,
		events : {
			
		},
		init : function(data) {
			this.oModuleContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
			this.selectorItemFilter = data.filterItemCssSelector;
			var items = Api.dom.byCssSelector(this.selectorItemFilter, this.oModuleContainer );
			this._setupItemFilter(items);
			
		},
		_setupItemFilter : function(items){
			Api.dom.each(items,  function( i , item){
				Api.events.bind('ifChanged',item, 
						function(e){
							var options = {	success:  function(data){
								var products = JSON.parse(data.products);
								var otherData = data.extraData;
			            		Bus.publish('products', 'products:ready', {  products: products , otherData : otherData });
							}};
							var form = Api.dom.byCssSelector("form[name='filterProductsForm']");
							form.ajaxSubmit(options);
				});
				
			});
		},
		onDestroy : function(){
		    this.oModuleContainer.html = null;
		    this.selectorItemFilter = null;
		}
	};
});

Hydra.module.register('list-product-module', function(Bus, Module, ErrorHandler, Api){
	return {
		sModule : '',
		oContainer : null,
		sProductItemtemplate : null,
		detailUrl : '',
		wishlistUrl : '',
		events : {
			'products' : {
				'products:ready' : function(data){
					var templateData = { imagesDirectoryPath : data.otherData.images_directory_path } ;
					this._updateProducts(data.products , templateData );
				}
			}
		},
		_updateProducts : function(products, templateData){
			Api.dom.byCssSelector(this.moduleCssContainerSelector).html('');
			var that = this;
			//fix hacerlo a traves de la API.}
			var i = 0;
			while( products[i] != undefined) {
					 var row = $('<div class="row"></div>');
					 template = Api.dom.clone(that.productItemTemplateCssSelector);
					 template.css('display' , 'block');
					 this._refreshTemplateData(template, products[i] , templateData);
					 row.append(template.html());
					 i++;
					 if ( products[i] != null || products[i] != undefined )
					 {
						 template = Api.dom.clone(that.productItemTemplateCssSelector);
						 template.css('display' , 'block');
						 this._refreshTemplateData(template, products[i] , templateData);
						 row.append(template.html());
					 }
					 Api.dom.byCssSelector(that.moduleCssContainerSelector).append(row);
				i++;
			}
		}, _refreshTemplateData : function(template, product, dataTemplate){
			 Api.dom.byCssSelector("h3[data-module-field='title']", template).html(product.name);
			 Api.dom.byCssSelector("span[data-module-field='price']", template).html(product.price);
			 Api.dom.byCssSelector("img[data-module-field='image_item']", template).attr('src', dataTemplate.imagesDirectoryPath +  product.imagePath);
			 Api.dom.byCssSelector("a[data-module-field='link-detail']", template).attr('href', this.detailUrl + product.id);
			 Api.dom.byCssSelector("a[data-module-field='link-wishlist']", template).attr('href', this.wishlistUrl + product.id);
			 
		 },init : function(data) {
			this.moduleCssContainerSelector = data.moduleCssContainerSelector;
			this.oContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
			this.productItemTemplateCssSelector = data.productItemTemplateCssSelector;
			var detailUrl = this.oContainer.data('detailUrl'); 
			this.detailUrl  = detailUrl.substring( 0 , detailUrl.length - 1);
			var wishlistUrl = this.oContainer.data('wishlistUrl'); 
			this.wishlistUrl  = wishlistUrl.substring( 0 , wishlistUrl.length - 1);			
		},
		onDestroy : function(){
			this.sModule = '';
			this.oContainer = null;
			this.sProductItemtemplate = null;
		}
	};
});


Hydra.module.register('map-module', function(Bus, Module, ErrorHandler, Api){
	return {
		moduleCssContainerSelector : '',
		oContainer : null,
		markers : null,
		mapOptions : null,
		map : null,
		events : {
			'products' : {
				'products:ready' : function(data){
					this._cleanMapMarkers();
					this._updateProducts(data.products);
				}
			}
		},
		_updateProducts : function(products){
			console.log(	this.moduleCssContainerSelector);
			var that = this;
			//fix hacerlo a traves de la API.
			var i = 0;
			while( products[i] != undefined) {
				 this._localizarProduct(products[i]);
				 i++;
			}
		},
		 _localizarProduct : function(product) {
	         var marker = this._buildMarker( new google.maps.LatLng(product.latitud, product.longitud) , product.price);
	         this.markers.push( marker);
		},
		_buildMarker : function(position , price){
			that = this;
			  var div = document.createElement('DIV');
				div.innerHTML ='<div class="tooltip top" role="tooltip" style="opacity:1;">' +
				   '<div class="tooltip-arrow"></div>'  +
					'<div class="tooltip-inner"> $'  + price +
 					'</div>'  +
				'</div>';
			return new RichMarker({
	        	map: that.map, 
	        	position: position,
	        	flat: true,
	            anchor: RichMarkerPosition.MIDDLE,
	            content: div
	         });
		},
		_cleanMapMarkers : function(){
			var marker;
			for (var i = 0 ; i < this.markers.length ; i++) {
				this.markers[i].setMap(null);
			}
			this.markers = [];
		},
		_addInitialsMarkers : function(){
				var that = this ;
				$('.hotel_container').each(function(index, value){
					var latitud = null, price = null, longitud = null,  marker = null;
					value = $(value);
					latitud = value.data('latitud');
					longitud = value.data('longitud');
					price = value.data('price');
					if ( latitud != undefined && longitud != undefined){
						marker = that._buildMarker( new google.maps.LatLng(latitud, longitud) , price);
						that.markers.push(marker);
					}
				});
		},
		init : function(data) {
			this.moduleCssContainerSelector = data.moduleCssContainerSelector;
			this.oContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
			this.markers = [];
			this.mapOptions = {zoom: 10, center: new google.maps.LatLng(18.1987192, -66.3526747), mapTypeControl: true , mapTypeControlOptions: {
			      style: google.maps.MapTypeControlStyle.DEFAULT,
			      mapTypeIds: [
			        google.maps.MapTypeId.ROADMAP,
			        google.maps.MapTypeId.TERRAIN
			      ]
			    }};
		    this.map = new google.maps.Map(document.getElementById(this.oContainer.attr('id')),   this.mapOptions);
		    this._addInitialsMarkers();
		   
		 },
		onDestroy : function(){
			this.moduleCssContainerSelector = '';
			this.oContainer = null;
			this.markers = null;
			this.mapOptions = null;
			this.map = null;
		}
	};
});

Hydra.module.register('filter-price-bar-module', function( Bus, Module, ErrorHandler, Api ){
	  return {
			moduleCssContainerSelector : '',
			oContainer : null,
			priceButton : null,
	        events:{
	        },
	        init: function (data) {
	        	this.moduleCssContainerSelector = data.moduleCssContainerSelector;
	        	this.inputCssSelector = data.inputCssSelector;
				this.oContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
	            this.priceButton = Api.dom.byCssSelector(this.inputCssSelector, this.oContainer , false);
	    		Api.events.bind('slideStop', this.priceButton, 
	    				function(e){
	    					console.log("price changed");
			    			var options = {	success:  function(data){
								var products = JSON.parse(data.products);
								var otherData = data.extraData;
			            		Bus.publish('products', 'products:ready', {  products: products , otherData : otherData });
							}};
			    			var form = Api.dom.byCssSelector("form[name='filterProductsForm']");
							form.ajaxSubmit(options);
				});
	            
	        },
	        onDestroy: function () {
	            this.oContainer.innerHTML = 'Destroyed content' + "_" + this.oContainer.id;
	        }
	    };
});	

Hydra.module.register('sort-module', function( Bus, Module, ErrorHandler, Api ){
	  return {
			moduleCssContainerSelector : '',
			oContainer : null,
			priceButton : null,
	        events:{
	        },
	        init: function (data) {
	        	this.moduleCssContainerSelector = data.moduleCssContainerSelector;
	        	this.filterItemCssSelector = data.filterItemCssSelector;
				this.oContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
				this.filterItems =   Api.dom.byCssSelector(data.filterItemCssSelector);
				Api.dom.each(this.filterItems ,  function( i , item){
					Api.events.bind('change',item, 
							function(e){
						var options = {	success:  function(data){
									var products = JSON.parse(data.products);
									var otherData = data.extraData;
				            		Bus.publish('products', 'products:ready', {  products: products , otherData : otherData });
								}};
								var form = Api.dom.byCssSelector("form[name='filterProductsForm']");
								var url = form.attr('action');
								form.ajaxSubmit(options);
					});
				});
	        },
	        onDestroy: function () {
	            this.oContainer.innerHTML = 'Destroyed content' + "_" + this.oContainer.id;
	        }
	    };
});	

Hydra.module.register('pagination-module', function( Bus, Module, ErrorHandler, Api ){
	  return {
			moduleCssContainerSelector : '',
			pageCssSelector : '',
			oContainer : null,
			priceButton : null,
	        events:{
				'products' : {
					'products:ready' : function(data){
						console.log("rendered view");
						
							this.oContainer.html(data.otherData.pager.paginatorHtml);
						if (data.otherData.pager.haveToPaginate){
							this._setupPagination();
						}
					}
				}
			},
	        init: function (data) {
	        	this.moduleCssContainerSelector = data.moduleCssContainerSelector;
	        	this.pageCssSelector = data.pageCssSelector;
				this.oContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
				this._setupPagination();
	        },
	        _setupPagination : function(items){
	        	var items = Api.dom.byCssSelector(this.pageCssSelector, this.oContainer );
				Api.dom.each(items,  function( i , item){
					Api.events.bind('click', item, 
		    				function(e){
								e.preventDefault();
				    			var options = {	success:  function(data){
												var products = JSON.parse(data.products);
												var otherData = data.extraData;
							            		Bus.publish('products', 'products:ready', {  products: products , otherData : otherData });
												},
												data : { 'page' : Api.dom.toObject(this).data('page')}
				    						};
				    			var form = Api.dom.byCssSelector("form[name='filterProductsForm']");
								form.ajaxSubmit(options);
					});
			  });
	        },
	        onDestroy: function () {
	            this.oContainer.innerHTML = 'Destroyed content' + "_" + this.oContainer.id;
	        }
	    };
});	


$(function(){
	
	var filters = $('div[data-container-for="list-product-module"]').data('filters');
	
	if (filters.type != undefined ){
		var typeSelector =  '#type_' + filters.type[0];
		var typeSelected = $(typeSelector).prop('checked', true);
	}
	if (filters.town != undefined ){
		var townSelector = '#town_' + filters.town[0];	
		var townSelected = $(townSelector).prop('checked', true);
	}
	
	Hydra.module.start(
	        ['town-filter-module' , 'town-filter-module' , 'list-product-module', 'map-module', 'filter-price-bar-module', 'pagination-module', 'sort-module'],    // Modules id
	['town-filter-module1', 'town-filter-module2' , 'list-product-module1', 'map-module1', 'filter-price-bar-module1', 'pagination-module1', 'sort-module'], // Instances id
	[  	{ moduleCssContainerSelector : "div[data-container-for='town-filter-module']" , filterItemCssSelector : "ul li  input" },
	    { moduleCssContainerSelector : "div[data-container-for='type-filter-module']" , filterItemCssSelector : "ul li  input" },
	   	{ moduleCssContainerSelector : "div[data-container-for='list-product-module']" , productItemTemplateCssSelector : "div[data-template-for='list-product-module']"},
		{ moduleCssContainerSelector : "div[data-container-for='map-module']" },
		{ moduleCssContainerSelector : "div[data-container-for='filter-price-bar-module']", inputCssSelector : "input.price-slider"  },
		{ moduleCssContainerSelector : "div[data-container-for='pagination-module']", pageCssSelector : "ul.pagination li a"  },
		{ moduleCssContainerSelector : "div[data-container-for='sort-module']" , filterItemCssSelector : ".styled-select-filters select" },
	]);
	

	return false;
});