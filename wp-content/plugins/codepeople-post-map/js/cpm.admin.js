/**
 * CodePeople Post Map 
 * Version: 1.0.1
 * Author: CodePeople
 * Plugin URI: http://wordpress.dwbooster.com
*/

(function ($) {
	var _latlng_btn,
		map_loaded = false,
        thumbnail_field;
	
	// thumbnail selection
    window["cpm_send_to_editor"] = function(html) {

        var file_url = jQuery(html).attr('href');
        if (file_url) {
            jQuery(thumbnail_field).val(file_url);
        }
        tb_remove();
        window.send_to_editor = window.cpm_send_to_editor_default;

    };
		
    window["cpm_send_to_editor_default"] = window.send_to_editor;
    
    window["cpm_thumbnail_selection"] = function(e){
        thumbnail_field = $(e).parent().find('input[type="text"]');
        window.send_to_editor = window.cpm_send_to_editor;
        tb_show('', 'media-upload.php?TB_iframe=true');
        return false;
    };
    
    //---------------------------------------------------------
    
    window['cpm_get_latlng'] = function (){
		var g  			= new google.maps.Geocoder(),
			f 			= _latlng_btn.parents('.point_form'),
			a 			= f.find('#cpm_point_address').val(),
			longitude 	= f.find('#cpm_point_longitude').val(),
			latitude 	= f.find('#cpm_point_latitude').val(),
			language	= f.find('#cpm_map_language').val(),
			request		= {};
		
		// Remove unnecessary spaces characters
		longitude = longitude.replace(/^\s+/, '').replace(/\s+$/, '');
		latitude  = latitude.replace(/^\s+/, '').replace(/\s+$/, '');
		a = a.replace(/^\s+/, '').replace(/\s+$/, '');
		
		if(longitude.length && latitude.length){
			request['location'] = new google.maps.LatLng(latitude, longitude);
		}else if(a.length){
			request['address'] = a.replace(/[\n\r]/g, '');
		}else{
			return false;
		}	

		g.geocode(request, function(result, status){
			if(status && status == "OK"){
				// Update fields
				var address   = result[0]['formatted_address'],
					latitude  = result[0]['geometry']['location'].lat(),
					longitude = result[0]['geometry']['location'].lng();

				if(address && latitude && longitude){
					f.find('#cpm_point_address').val(address);
					f.find('#cpm_point_longitude').val(longitude);
					f.find('#cpm_point_latitude').val(latitude);
					
					// Load Map
					cpm_load_map(f.find('.cpm_map_container'),latitude, longitude);
				}
			}else{
				alert('The point is not located');
			}
			
		});
	};		
	
	window['cpm_edit_point'] = function(id){
		var f = $('#point_form'+id);
		if(f.length && f.is(":hidden")){
			$('.point_form').hide();
			f.show();
			var latitude = f.find('#cpm_point_latitude').val(),
				longitude = f.find('#cpm_point_longitude').val();
			if(!is_empty(latitude) && !is_empty(longitude)){
					// Load Map
					cpm_load_map(f.find('.cpm_map_container'),latitude, longitude);
				}
		}
		
	};
	
	window['cpm_delete_point'] = function(id, e){
		$('#point_form'+id).remove();
		$('#point_form').show();
		$(e).parent('div').remove();
	};
	
	function is_empty(v){
		return /^\s*$/.test(v);
	};
	
	function clear_form(){
		var f = $('#point_form'),
			d = $('#cpm_map_default_icon').val();

		f.find('input[type="text"]').val("");
		f.find('#cpm_point_thumbnail').val("");
		f.find('#selected_icon').val(d);
		f.find('.cpm_selected').removeClass('cpm_selected');
		f.find('img[src="'+d+'"]').parent().addClass('cpm_selected');
		
		// Clear map
		f.find('.cpm_map_container').replaceWith('<div id="cpm_map_container0" class="cpm_map_container" style="width:400px; height:250px; border:1px dotted #CCC;"><div style="margin:20px;">To correct the latitude and longitud directly on MAP, type the address and press the Verify button.</div></div>');
			
	}
	
	// Check the point or address existence
	window['cpm_checking_point'] = function (e){
		var language = 'en';
		_latlng_btn = $(e);
		if(typeof google != 'undefined' && google.maps){
			cpm_get_latlng();
		}else{
			$('<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false'+((language) ? '&language='+language: '')+'&callback=cpm_get_latlng"></script>').appendTo('body');
		}
	};
	
	window['cpm_load_map'] = function(container, latitude, longitude){
		var c = container,
			f = c.parents('.point_form'),
			p = new google.maps.LatLng(latitude, longitude),
			m = new google.maps.Map(c[0], {
								zoom: 5,
								center: p,
								mapTypeId: google.maps.MapTypeId['ROADMAP'],
								
								// Show / Hide controls
								panControl: true,
								scaleControl: true,
								zoomControl: true,
								mapTypeControl: true,
								scrollWheel: true
						}),
			mk = new google.maps.Marker({
							  position: p,
							  map: m,
							  icon: new google.maps.MarkerImage(cpm_default_marker),
							  draggable: true
						 });
			
			google.maps.event.addListener(mk, 'position_changed', function(){
				f.find('#cpm_point_latitude').val(mk.getPosition().lat());
				f.find('#cpm_point_longitude').val(mk.getPosition().lng());
			});				
	};
	
	window['cpm_set_map_flag'] = function(){
		map_loaded = true;
	};
	
    window[ 'cpm_display_more_info' ] = function( e ){
        e = $( e );
        e.parent().hide().next( '.cpm_more_info' ).show();
    };
    
    window[ 'cpm_hide_more_info' ] = function( e ){
        e = $( e );
        e.parent().hide().prev( '.cpm_more_info_hndl' ).show();
    };
    
    function enable_disable_fields(f, v){
        var p = f.parents('#map_data');
        p.find('input[type="text"]').attr({'DISABLED':v,'READONLY':v});
        p.find('select').attr({'DISABLED':v,'READONLY':v});
        p.find('input[type="checkbox"]').filter('[id!="cpm_map_single"]').attr({'DISABLED':v,'READONLY':v});
    };
        
	$(function(){
		// Actions for icons
		$(".add_point").bind('click', function(){
			var f = $('.point_form:visible'),
				v = f.find('#cpm_point_address').val(),
                lat = f.find('#cpm_point_latitude').val(),
                lng = f.find('#cpm_point_longitude').val();
			v = v.replace(/'/g, "\'").replace(/"/g, '\"');

			if(!(is_empty(v) || is_empty(lat) || is_empty(lng))){
				var	c = f.clone(true),
					id = f.find('#cpm_point_id');

				if(id.length){
					var id_val = id.val();
					$('#cpm_point'+id_val).find('span').text(v);
					$('#point_form'+id_val).hide();
					$('#point_form').show();
				}else{
					c.attr('id', 'point_form'+cpm_point_counter);
					c.append('<input type="hidden" id="cpm_point_id" value="'+cpm_point_counter+'" />');
					c.find('input').each(function(){
						var n = $(this).attr('name');
							
						if(n){
							n = n.replace('[0]', '['+cpm_point_counter+']');
							$(this).attr('name', n);
						}	
					});	
				
					f.after(c.hide());
					$("#points_container").append('<div class="button" id="cpm_point'+cpm_point_counter+'" style="display:inline-block;height:auto;"><span onclick="cpm_edit_point('+cpm_point_counter+')">'+v+'</span><input type="button" value="X" onclick="cpm_delete_point('+cpm_point_counter+', this);"  /></div>');
					cpm_point_counter++;
					clear_form();
				}
			}else{
				alert('Address, latitude and longitude are required. Please, enter the address and press the verify button.');
			}	
		});
		
        $(".cpm_icon").bind('click', function(){
			var  i = $(this),
				 f = i.parents('.point_form');
			
			f.find('.cpm_icon.cpm_selected').removeClass('cpm_selected');
			i.addClass('cpm_selected');
			f.find('#selected_icon').val($('img', i).attr('src'));
		}).mouseover(function(){
			$(this).css({"border":"solid #BBBBBB 1px"})
		}).mouseout(function(){
			$(this).css({"border":"solid #F9F9F9 1px"})
		});
		
		// Action for insert shortcode 
		$('#cpm_map_shortcode').click(function(){
            if(window.cpm_send_to_editor_default)
                window.send_to_editor = window.cpm_send_to_editor_default;
        	if(send_to_editor){
        		send_to_editor('[codepeople-post-map]');
			}
            var t = $('#content');
            if(t.length){
                var v= t.val()
                if(v.indexOf('codepeople-post-map') == -1)
                    t.val(v+'[codepeople-post-map]');
            }
        });
		
		// Create the script tag and load the maps api
		if($('.cpm_map_container').length){
			$('<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&callback=cpm_set_map_flag"></script>').appendTo('body');
		};
        
        $('#cpm_map_single').each(function(){
            var f = $(this);
            enable_disable_fields(f, !f[0].checked);
            f.click(function(){
                enable_disable_fields(f,!f[0].checked);
            });
        });
        
        $('#cpm_map_stylized').click(function(){
			if( this.checked ) $('#cpm_map_styles').attr( { 'disabled' : false, 'readonly' : false });
			else  $('#cpm_map_styles').attr( { 'disabled' : true, 'readonly' : true });
		});
	});
})(jQuery);