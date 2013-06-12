function woo_js_querystring(ji) {

	hu = window.location.search.substring(1);
	gy = hu.split( "&" );
	for (i=0;i<gy.length;i++) {
	
		ft = gy[i].split( "=" );
		if (ft[0] == ji) {
		
			return ft[1];
		
		} // End IF Statement
		
	} // End FOR Loop
	
} // End woo_js_querystring()
	
(
	
	function(){
	
		// Get the URL to this script file (as JavaScript is loaded in order)
		// (http://stackoverflow.com/questions/2255689/how-to-get-the-file-path-of-the-currenctly-executing-javascript-code)
		
		var scripts = document.getElementsByTagName( "script"),
		src = scripts[scripts.length-1].src;
		
		if ( scripts.length ) {
		
			for ( i in scripts ) {

				var scriptSrc = '';
				
				if ( typeof scripts[i].src != 'undefined' ) { scriptSrc = scripts[i].src; } // End IF Statement
	
				var txt = scriptSrc.search( 'shortcode-generator' );
				
				if ( txt != -1 ) {
				
					src = scripts[i].src;
				
				} // End IF Statement
			
			} // End FOR Loop
		
		} // End IF Statement

		var framework_url = src.split( '/js/' );
		
		var icon_url = framework_url[0] + '/images/shortcode-icon.png';
	
		tinymce.create(
			"tinymce.plugins.WooThemesShortcodes",
			{
				init: function(d,e) {
						d.addCommand( "wooVisitWooThemes", function(){ window.open( "http://woothemes.com/" ) } );
						
						d.addCommand( "wooOpenDialog",function(a,c){
							
							// Grab the selected text from the content editor.
							selectedText = '';
						
							if ( d.selection.getContent().length > 0 ) {
						
								selectedText = d.selection.getContent();
								
							} // End IF Statement
							
							wooSelectedShortcodeType = c.identifier;
							wooSelectedShortcodeTitle = c.title;
							
							
							jQuery.get(e+"/dialog.php",function(b){
								
								jQuery( '#woo-options').addClass( 'shortcode-' + wooSelectedShortcodeType );
								jQuery( '#woo-preview').addClass( 'shortcode-' + wooSelectedShortcodeType );
								
								// Skip the popup on certain shortcodes.
								
								switch ( wooSelectedShortcodeType ) {
							
									// Highlight
									
									case 'highlight':
								
									var a = '[highlight]'+selectedText+'[/highlight]';
									
									tinyMCE.activeEditor.execCommand( "mceInsertContent", false, a);
								
									break;
									
									// Dropcap
									
									case 'dropcap':
								
									var a = '[dropcap]'+selectedText+'[/dropcap]';
									
									tinyMCE.activeEditor.execCommand( "mceInsertContent", false, a);
								
									break;
							
									default:
									
									jQuery( "#woo-dialog").remove();
									jQuery( "body").append(b);
									jQuery( "#woo-dialog").hide();
									var f=jQuery(window).width();
									b=jQuery(window).height();
									f=720<f?720:f;
									f-=80;
									b-=84;
								
								tb_show( "Insert "+ wooSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=woo-dialog" );jQuery( "#woo-options h3:first").text( "Customize the "+c.title+" Shortcode" );
								
									break;
								
								} // End SWITCH Statement
							
							}
													 
						)
						 
						} 
					);
						
						// d.onNodeChange.add(function(a,c){ c.setDisabled( "woothemes_shortcodes_button",a.selection.getContent().length>0 ) } ) // Disables the button if text is highlighted in the editor.
					},
					
				createControl:function(d,e){
				
						if(d=="woothemes_shortcodes_button"){
						
							d=e.createMenuButton( "woothemes_shortcodes_button",{
								title:"Insert WooThemes Shortcode",
								image:icon_url,
								icons:false
								});
								
								var a=this;d.onRenderMenu.add(function(c,b){
									b.addSeparator();
									a.addWithDialog(b,"Accordion","accordion" );
									a.addWithDialog(b,"Alert","alert" );
									a.addWithDialog(b,"Badge","badge" );
									a.addWithDialog(b,"Block Message","block-message");
									a.addWithDialog(b,"Blockquote","blockquote" );
									a.addWithDialog(b,"Button","button" );
									c=b.addMenu({title:"Column Layout"});
										a.addImmediate(c,"Column Full","[column_full][/column_full] " );
										a.addImmediate(c,"Column Wrap","[column_wrap][/column_wrap] " );
										a.addImmediate(c,"Column Half","[column_half][/column_half] " );
										a.addImmediate(c,"Column Two Third","[column_two_third][/column_two_third]" );
										a.addImmediate(c,"Column One Third","[column_one_third][/column_one_third] " );
										a.addImmediate(c,"Column Three Fourth","[column_three_fourth][/column_three_fourth] " );
										a.addImmediate(c,"Column One Fourth","[column_one_fourth][/column_one_fourth] " );
										a.addImmediate(c,"Column Five Sixth","[column_five_sixth][/column_five_sixth] " );
										a.addImmediate(c,"Column One Sixth","[column_one_sixth][/column_one_sixth] " );
										a.addImmediate(c,"Column Eleven Twelveth","[column_eleven_twelveth][/column_eleven_twelveth]" );
										a.addImmediate(c,"Column One Twelveth","[column_one_twelveth][/column_one_twelveth] " );
									a.addImmediate(b,"Code","[code] [/code]" );
									a.addImmediate(b,"Divider","[divider]" );
					// WIP			a.addImmediate(b,"Gallery Slider","[gt_slider]" );
									a.addWithDialog(b,"Hero","hero" );
									a.addWithDialog(b,"Icon","icon" );
									a.addWithDialog(b,"Label","label" );
									a.addWithDialog(b,"Table","table" );
									a.addWithDialog(b,"Tabset","tab" );
									a.addWithDialog(b,"Tagline","tagline" );
									a.addWithDialog(b,"Tooltip","tooltip" );
									c=b.addMenu({title:"Video"});
										a.addWithDialog(c,"Youtube","youtube" );
										a.addWithDialog(c,"Vimeo","vimeo" );
									b.addSeparator();
								});
							return d
						
						} // End IF Statement
						
						return null
					},
		
				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})},
				
				addWithDialog:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "wooOpenDialog",false,{title:e,identifier:a})}})},
		
				getInfo:function(){ return{longname:"WooThemes Shortcode Generator",author:"VisualShortcodes.com",authorurl:"http://visualshortcodes.com",infourl:"http://visualshortcodes.com/shortcode-ninja",version:"1.0"} }
			}
		);
		
		tinymce.PluginManager.add( "WooThemesShortcodes",tinymce.plugins.WooThemesShortcodes)
	}
)();
