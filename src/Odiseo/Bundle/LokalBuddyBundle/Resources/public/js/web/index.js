INDEX = (function($) {

	var data = [];
	var _init = function() {
		towns = $('.nav-searchfield-outer').data('autocompleteOptions');

		$(towns).each(function(i, value) {
			data[i] = {
				label : value.name,
				category : value.regionName,
				id : value.id
			};
		});

		$("#searchDropdownBox").change(function(e) {
			var Search_Str = $(this).children('option:selected').text();
			//replace search str in span value
			$("#nav-search-in-content").text(Search_Str);
		});

		$.widget("custom.catcomplete", $.ui.autocomplete, {
			_create : function() {
				this._super();
				this.widget().menu("option", "items",
						"> :not(.ui-autocomplete-category)");
			},
			_renderMenu : function(ul, items) {
				var that = this, currentCategory = "";
				$.each(items, function(index, item) {
					var li;
					if (item.category != currentCategory) {
						ul.append("<li class='ui-autocomplete-category'>"
								+ item.category + "</li>");
						currentCategory = item.category;
					}
					li = that._renderItemData(ul, item);
					if (item.category) {
						li.attr("aria-label", item.category + " : "	+ item.label);
						li.attr("id" , item.id);
					}
				});
			}
		});

		$("#twotabsearchtextbox").catcomplete({
			delay : 0,
			source : data,
			select: function( event, ui ) {
				$('#townInput').val(ui.item.id);
			}
		});
		
	}

	$(function() {

		_init();

	});

	return {

	};

})(jQuery);
