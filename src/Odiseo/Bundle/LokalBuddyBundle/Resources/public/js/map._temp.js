function hideAllMarkers () {
	for (var key in markers)
		markers[key].forEach(function (marker) {
			marker.setMap(null);
		});
};

function closeInfoBox() {
	$('div.infoBox').remove();
};

function getInfoBox(item) {
	return new InfoBox({
		content:
		'<div class="marker_info" id="marker_info">' +
		'<img src="' + item.map_image_url + '" alt=""/>' +
		'<h3>'+ item.name_point +'</h3>' +
		'<span>'+ item.description_point +'</span>' +
		'<a href="'+ item.url_point + '" class="btn_1">Details</a>' +
		'</div>',
		disableAutoPan: true,
		maxWidth: 0,
		pixelOffset: new google.maps.Size(40, -190),
		closeBoxMargin: '5px -20px 2px 2px',
		closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
		isHidden: false,
		pane: 'floatPane',
		enableEventPropagation: true
	});


};

$(function()
{
	(function(A) {
		if (!Array.prototype.forEach)
			A.forEach = A.forEach || function(action, that) {
				for (var i = 0, l = this.length; i < l; i++)
					if (i in this)
						action.call(that, this[i], i, this);
			};
	})(Array.prototype);

	var
	mapObject,
	markers = [],
	markersData = {
		'Single_hotel': [
		{
			name: 'Hotel Mariott',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Hotel Mariott',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard.',
			url_point: '#'
		}
		],
		'Sightseeing': [
		{
			name: 'Open Bus',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Open Bus',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		},
		{
			name: 'Senna River Tour',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Senna River Tour',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		}
		],
		'Museums': [
		{
			name: 'Louvre',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Louvre',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		},
		{
			name: 'Pompidou ',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Pompidou',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		}
		],
		'Skyline': [
		{
			name: 'Tour Eiffel',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Tour Eiffel',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		},
		{
			name: 'Montparnasse',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Montparnasse',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		}
		],
		'Eat_drink': [
		{
			name: 'Beaubourg',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Beaubourg',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		},
		{
			name: 'St. Germain des Prés',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'St. Germain des Prés',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		}
		],
		'Walking': [
		{
			name: 'Trocadero',
			location_latitude: 18.245678, 
			location_longitude: -67.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Trocadero',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		},
		{
			name: 'Champs-Élysées',
			location_latitude: 18.285678, 
			location_longitude: -67.120094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Champs-Élysées',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		}
		],
		'Churches': [
		{
			name: 'Notre Dame',
			location_latitude: 18.225678, 
			location_longitude: -66.020094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Notre Dame',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		},
		{
			name: 'Madeleine',
			location_latitude: 18.235678, 
			location_longitude: -67.040094,
			map_image_url: '/bundles/odiseoadscandy/img/thumb_map_1.jpg',
			name_point: 'Madeleine',
			description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard',
			url_point: '#'
		}
		]
	};

	var mapOptions = {
		zoom: 9,
		center: new google.maps.LatLng(18.2854534, -66.4419387),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		panControl: false,
		panControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		scrollwheel: true,
		scaleControl: false,
		scaleControlOptions: {
			position: google.maps.ControlPosition.TOP_LEFT
		},
		streetViewControl: true,
		streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_TOP
		},
		styles: [/*map styles*/]
	};
		
	var
		marker;
		mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
		
	for (var key in markersData)
		markersData[key].forEach(function (item) {
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
				map: mapObject,
				icon: '/bundles/odiseoadscandy/img/pins/' + key + '.png',
			});

			if ('undefined' === typeof markers[key])
				markers[key] = [];
			markers[key].push(marker);
			google.maps.event.addListener(marker, 'click', (function () {
				closeInfoBox();
				getInfoBox(item).open(mapObject, this);
				mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
			}));
		});
});