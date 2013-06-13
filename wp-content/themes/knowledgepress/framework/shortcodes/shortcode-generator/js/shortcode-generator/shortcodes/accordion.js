wooShortcodeMeta={
	attributes:[
		{
			label:"Accordion",
			id:"content",
			controlType:"tab-control",
			text:"Number of Accordions"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			var tabTitles = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			var tabberStyle = b.style;
			var tabberTitle = b.tabberTitle;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
				var currentField = 'tle_' + ( i + 1 );

				if ( b[currentField] == '' ) {
				
					tabTitles.push( 'Accordion ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle = b[currentField];
					
					currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[accordion]';

			var i = 0;
			for ( var t in tabTitles ) {
				i++;
				g += '[accordion_pane accordion_title="'+ tabTitles[t] +'"]Accordion '+i+' content.[/accordion_pane] ';
			} // End FOR Loop
			
			g += '[/accordion]';

			return g
		
		}
};