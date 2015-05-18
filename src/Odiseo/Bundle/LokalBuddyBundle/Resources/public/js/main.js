Hydra.module.register('search-bar-module', function( Bus, Module, ErrorHandler, Api ){
	  return {
	        sModule: 'search-bar-module',
	        oContainer: null,
	        inputField : null,
	        buttonSearch : null,
	        events:{
	        	
	        },
	        init: function (oContainer) {
		            this.oContainer = oContainer;
		            this.buttonSearch = Api.dom.byCssSelector('#button_search', oContainer , false);
		            this.buttonSearch.click(function(){
		            	var url = 'searchMediaForUserName/'.concat(Api.dom.byId('to_search').val());
		            	console.log(url);
						var options = {  method: "POST",  url: url,	  data: {} , cache : false };
		            	Api.ajax.call(options).done(function(data){
		            		var products = JSON.parse(data.products);
		            		Bus.publish('products', 'products:ready', {  products: products });
		            	});
	            	}
	            );
	            
	        },
	        onDestroy: function () {
	            this.oContainer.innerHTML = 'Destroyed content' + "_" + this.oContainer.id;
	        }
	    };
});	

Hydra.module.register('list-product-module', function(Bus, Module, ErrorHandler, Api){
	var that = this;
	return {
		sModule : '',
		oContainer : null,
		sProductItemtemplate : null,
		events : {
			'products' : {
				'products:ready' : function(data){
					this._updateProducts(data.products);
				}
			}
		},
		_updateProducts : function(products){
			console.log(	this.moduleCssContainerSelector);
			Api.dom.byCssSelector(this.moduleCssContainerSelector).html('');
			var that = this;
			//fix hacerlo a traves de la API.
			 for(i = 0; i < products.length; i++) { 
				 var row = $('<div class="row"></div>');
				 template = Api.dom.clone(that.productItemTemplateCssSelector);
				 template.css('display' , 'block');
				 this._refreshTemplateData(template, products[i]);
				 row.append(template.html());
				 i++;
				 if ( products[i] != null || products[i] != undefined )
				 {
					 template = Api.dom.clone(that.productItemTemplateCssSelector);
					 template.css('display' , 'block');
					 this._refreshTemplateData(template, products[i]);
					 row.append(template.html());
				 }
				 Api.dom.byCssSelector(that.moduleCssContainerSelector).append(row);
			}
		}, _refreshTemplateData : function(template, dataTemplate){
			 Api.dom.byCssSelector("h3[data-module-field='title']", template).html(dataTemplate.title);
			 Api.dom.byCssSelector("span[data-module-field='price']", template).html(dataTemplate.price);
			 
		 },init : function(data) {
			this.moduleCssContainerSelector = data.moduleCssContainerSelector;
			this.oContainer = Api.dom.byCssSelector(data.moduleCssContainerSelector);
			this.productItemTemplateCssSelector = data.productItemTemplateCssSelector;
			
			
		},
		onDestroy : function(){
		    this.oContainer.innerHTML = '';
		    this.oContainer = null;
		}
	};
	
});


Hydra.module.register('test-module', function(Bus, Module, ErrorHandler, Api){
	return {
		sModule : 'test-module-container',
		oContainer : null,
		events : {
			
		},
		init : function(oContainer) {
			this.oContainer = oContainer;
			console.log(oContainer);
		},
		onDestroy : function(){
		    this.oContainer.innerHTML = '';
		    this.oContainer = null;
		}
	};
	
});

Hydra.module.register('simple-product-type-filter-module', function(Bus, Module, ErrorHandler, Api){
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
			var that = this;
			Api.dom.each(items,  function( i , item){
				Api.events.bind('click',item, 
						function(e){	
							e.preventDefault();	
							var active = Api.dom.byCssSelector('#active', this.oModuleContainer );
							active.attr('id' , '');
							$(this).attr('id', 'active');
							
							var url =  this.href;
			            	console.log(url);
							var options = {  method: "POST",  url: url,	  data: {} , cache : false };
			            	Api.ajax.call(options).done(function(data){
			            		var products = JSON.parse(data.products);
			            		Bus.publish('products', 'products:ready', {  products: products });
			            	});
						});
				
			});
		},
		onDestroy : function(){
		    this.oModuleContainer.html = null;
		    this.selectorItemFilter = null;
		}
	};
	
});

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
			var that = this;
			Api.dom.each(items,  function( i , item){
				Api.events.bind('click',item, 
						function(e){	
							e.preventDefault();	
							console.log(item);
						});
				
			});
		},
		onDestroy : function(){
		    this.oModuleContainer.html = null;
		    this.selectorItemFilter = null;
		}
	};
});



$(function(){
	 Hydra.module.start(
	            ['list-product-module', 'search-bar-module', 'simple-product-type-filter-module',  'town-filter-module'],    // Modules id
	            ['list-product-module1' , 'search-bar-module1','simple-product-type-filter-module1','town-filter-module1' ], // Instances id
	            [  { moduleCssContainerSelector : "div[data-container-for='list-product-module']" , productItemTemplateCssSelector : "div[data-template-for='list-product-module']"},
	               $('#search_bar'),
	               { moduleCssContainerSelector :"div[data-container-for='simple-product-type-filter-module']" , filterItemCssSelector : "li>a" },
	               { moduleCssContainerSelector :"div[data-container-for='town-filter-module']" , filterItemCssSelector : "ul li input" }
	               
	               ]);
	
});