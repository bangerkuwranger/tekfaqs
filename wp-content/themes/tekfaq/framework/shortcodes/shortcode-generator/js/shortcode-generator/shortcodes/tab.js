wooShortcodeMeta={
	attributes:[
		{
			label:"Tab",
			id:"content",
			controlType:"tab-control",
			text:"Select Number of Tabs"
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
			
			var g = '', h = '', d = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
				var currentField = 'tle_' + ( i + 1 );

				if ( b[currentField] == '' ) {
				
					tabTitles.push( 'Tab ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle = b[currentField];
					
					currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[tabset]';
			
			h += '[tab_head]';
			d += '[tab_content]';
			var i = 0;
			for ( var t in tabTitles ) {
				i++;
				h += '[tab_title '+ ( i==1 ? 'active="active"' : '') + ' sequence="'+i+'"]' + tabTitles[t] + '[/tab_title] ';
				d += '[tab_pane '+ ( i==1 ? 'active="active"' : '') + ' sequence="'+i+'"] Tab ' + tabTitles[t] + ' content goes here.[/tab_pane] ';
			
			} // End FOR Loop
			
			h += '[/tab_head]';
			d += '[/tab_content]';
			
			g += h+d+ '[/tabset]';

			return g
		
		}
};