/**
 * CodePeople Post Map 
 * Version: 1.0.1
 * Author: CodePeople
 * Plugin URI: http://wordpress.dwbooster.com
*/

jQuery(function(){
	(function($){
		// Create a class with CodePeople Post Map functionalities and attributes
		$.CPM = function(container, config){
			this.data = $.extend(true, {}, this.defaults, config);
			this.container = container;
		}; 
		
		$.CPM.prototype = {
			markers : [],
			windows : [],
			defaults : {
				markers 		: [],
				zoom			: 10,
                dynamic_zoom    : false,
				type			: 'ROADMAP',
				mousewheel 		: true,
				scalecontrol 	: true,
				zoompancontrol 	: true,
				typecontrol 	: true,
                show_window     : true,
                show_default    : true,
				display			: 'map',
				highlight		: true,
                route           : false,
                mode            : 'DRIVING',
				highlight_class : 'cpm_highlight'
			},
			
			// private methods to complete every steps in map generation
			
			_empty : function (v){
				return (!v || /^\s*$/.test(v));
			},
			
			_get_latlng : function(i){
				var me = this,
					g  = new google.maps.Geocoder(),
					m  = me.data.markers,
					a  = m[i]['address'];
				
				g.geocode({address:a}, function(result, status){
					me.counter--;
					if(status && status == "OK"){
                        m[i]['latlng'] = new google.maps.LatLng(result[0]['geometry']['location'].lat(), result[0]['geometry']['location'].lng())
					}else{
						m[i]['invalid'] = true;
					}
					
					// All points have been checked now is possible to load the map
					if(me.counter == 0){
						me._load_map();
                        
                        // Set Route
                        me._set_route();
                    }
				});
			},
			
            _set_route : function(){
                var me = this,
                    m  = me.data.markers;
                
                if(!me.data.route) return;
                // Create the matix of waypoints
                var wps_list = [],
                    c = -1,
                    d = 1,
                    post = '';
                
                for(var i = 0, h = m.length; i < h; i++){
                    if(!m[i]['invalid']){
                        if(m[i].post != post || d%9 == 0){
                            c++;
                            wps_list[c] = [];
                            
                            if(d%9 == 0 && m[i].post == post){
                                wps_list[c].push(wps_list[c-1][wps_list[c-1].length-1]);
                            }
                            
                            post = m[i].post;
                            d = 1;
                        } 
                       
                        wps_list[c].push({location:m[i].latlng});
                        d++;
                    }
                }
                
                for(var i = 0, h = wps_list.length; i < h; i++){
                    var rendererOptions   = { map: me.map, suppressMarkers: true },
                        directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions),
                        directionsService = new google.maps.DirectionsService(),
                        wps = wps_list[i],
                        origin, destination, request;
                    
                    
                    var l = wps.length;
                    if( l > 1){
                        
                        request = {
                            origin : wps.shift().location,
                            destination : wps.pop().location,
                            waypoints : wps,
                            travelMode: google.maps.DirectionsTravelMode[me.data.mode]
                        };
                        
                        directionsService.route(
                            request, 
                            (function (dd) {
                                return function(response, status) {
                                    if (status == google.maps.DirectionsStatus.OK) {
                                        dd.setDirections(response);
                                    }
                                    else
                                        if(console)
                                            console.log('failed to get directions');
                                }
                            })(directionsDisplay)        
                        );
                    }
                }    
            },
            _str_transform : function( t ){
                return t.replace( /&lt;/g, '<').replace( /&gt;/g, '>').replace( /&amp;/g, '&').replace( /&quot;/g, '"').replace(/\\'/g, "'");
            },
			_load_map : function(){
			
				var me = this,
					m  = me.data.markers,
					h  = m.length,
					c  = 0,
					v  = 0; // Number of valid points
				
				while(c < h && m[c]['invalid']) c++;
				
				if(c < h){
					me.map = new google.maps.Map( me.container, {
							zoom: me.data.zoom,
							center: m[c].latlng,
							mapTypeId: google.maps.MapTypeId[me.data.type],
							
							// Show / Hide controls
							panControl: me.data.zoompancontrol,
							scaleControl: me.data.scalecontrol,
							zoomControl: me.data.zoompancontrol,
							mapTypeControl: me.data.typecontrol,
							scrollwheel: me.data.mousewheel
					});

					if( typeof me.data[ 'map_styles' ] != 'undefined' ) me.map.setOptions({styles: me.data.map_styles });
					var map = me.map,
						bounds = new google.maps.LatLngBounds (),
						open_by_default;
					
                    if(me.data.show_default){
                        google.maps.event.addListenerOnce(map, 'idle', function(){
                            setTimeout(function(){
                                if(open_by_default)
                                            google.maps.event.trigger(me.markers[open_by_default - 1], 'click');
                            }, 1000);				
                        });
                    }
                    
					me.infowindow = new google.maps.InfoWindow({maxWidth:340});

					for (var i = c; i < h; i++){		
						if(!m[i]['invalid']){
							bounds.extend(m[i].latlng);
							var marker = new google.maps.Marker({
														  position: m[i].latlng,
														  map: map,
														  icon: new google.maps.MarkerImage(m[i].icon),
														  title:((m[i].address) ? me._str_transform( m[i].address ) : '')
														 });
					  
							marker.id = i;
							me.markers.push(marker);
							if( typeof open_by_default == 'undefined' ){
								open_by_default = me.markers.length;
							}
							
							google.maps.event.addListener(marker, 'click', function(){ me.open_infowindow(this); });
							google.maps.event.addListener(marker, 'mouseover', function(){ me.set_highlight(this); });
							google.maps.event.addListener(marker, 'mouseout', function(){ me.unset_highlight(this); });
						}
					}	
					
					if (h > 1 && me.data.dynamic_zoom) {
					  map.fitBounds(bounds);
					}
					else if (h == 1 || !me.data.dynamic_zoom) {
                      map.setCenter(bounds.getCenter());
					  map.setZoom(me.data.zoom);
					}
				}
			},
			
			// public methods
			set_map: function(){
                var me = this;
				if(me.data.markers.length){
					
					var m = me.data.markers,
						h = m.length;
					
					me.counter = h; // Counter is used to know the momment where all latitudes or longitudes were calculated
					
					for(var i=0; i < h; i++){
						if( (me._empty(m[i].lat) || me._empty(m[i].lng)) && !me._empty(m[i].address)){
							me._get_latlng(i);
						}else if(me._empty(m[i].lat) && me._empty(m[i].lng)){
							// The address is not present so the point may be removed from the list
							m[i]['invalid'] = true;
							me.counter--;
						}else{
                            m[i]['latlng'] = new google.maps.LatLng(m[i].lat, m[i].lng);
							me.counter--;
						}
						
					}
					
					// All points have been checked now is possible to load the map
					if(me.counter == 0){
						me._load_map();
                        
                        // Set Route
                        me._set_route();
					}
				}
			},
			
			// Open the marker bubble
			open_infowindow : function(m){
                if( !this.data.show_window ) return;
				this.infowindow.setContent(this._str_transform(this.data.markers[m.id].info));
				this.infowindow.open(this.map, m);
			},	
			
			// Set the highlight class to the post with ID m['post']
			set_highlight : function(m){
				if(this.data.highlight){
					var id = this.data.markers[m.id]['post'];
					$('.post-'+id).addClass(this.data.highlight_class);
				}	
			},
			
			// Remove the highlight class from the post with ID m['post_id']
			unset_highlight : function(m){
				if(this.data.highlight){
					var id = this.data.markers[m.id]['post'];
					$('.post-'+id).removeClass(this.data.highlight_class);
				}
			}
		};	
		// End CPM class definition
		
		// Load the street view on infowindow
		
		$( document ).on( 'click', '#cpm_display_streetview_btn', function(){
			var me = $(this),
				c = me.parents( '.cpm-map' ),
				latlng = new google.maps.LatLng( me.attr( 'lat' ), me.attr( 'lng' ) ),
			    st = new google.maps.StreetViewPanorama( 
															c[ 0 ], 
															{
																'position': latlng,
																'enableCloseButton': true
															} 
														);
			st.setVisible(true);
		} );
		
		
		// Callback function to be called after loading the maps api
		function initialize( e )
		{
			var map_container = $( e ),
				map_id = map_container.attr('id');

			if( map_container.parent().is( ':hidden' ) )
			{
				setTimeout( function(){ initialize( e ); }, 500 );
				return;
			}
			
			if(cpm_global && cpm_global[map_id] && cpm_global[map_id]['markers'].length){
				// The maps data are defined
				var cpm = new $.CPM( e, cpm_global[map_id]);
				
				// Display map
				if(cpm_global[map_id]['display'] == 'map'){
					map_container.show();
					cpm.set_map();
				}else{
					// Insert a icon to display map
					var map_icon = $('<div class="cpm-mapicon"></div>');
					map_icon.click(function(){
						map_container.show();
						cpm.set_map();
					});
					map_icon.insertBefore(map_container);
				}	
				
				
			}
		};
		window['cpm_init'] = function(){
			$('.cpm-map').each(function(){
			
				if( $( this ).parent().is( ':hidden' ) )
                {
					setTimeout(
						( function ( e )
							{
								return function(){ initialize( e ); };
							} )( this ),
						500
					);
				}
				else
				{
					initialize( this );
				}	
				
			});
		};
		
		var map = $('.cpm-map');
		if(map.length){
            if(typeof google == 'undefined' || google['maps'] == null){
                // Create the script tag and load the maps api
                var script=document.createElement('script');
                script.type  = "text/javascript";
                script.src='http://maps.google.com/maps/api/js?sensor=false'+((typeof cpm_language != 'undefined' && cpm_language.lng) ? '&language='+cpm_language.lng: '')+'&callback=cpm_init';
                document.body.appendChild(script);
            }else{
                cpm_init();
            }
        }	
		
	})(jQuery);
});