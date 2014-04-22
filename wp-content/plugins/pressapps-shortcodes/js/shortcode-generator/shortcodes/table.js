gpShortcodeMeta={
	attributes:[
		{
			label:"Column",
			id:"content",
			controlType:"tab-control",
			text:"Number of Column..."
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
				
					tabTitles.push( 'Column ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle = b[currentField];
					
					currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[table_wrap]';
			
			h += '[table_columns]';
			d += '[table_content][table_row]';
			var i = 0;
			for ( var t in tabTitles ) {
				i++;
				h += '[table_column] Column ' +i+ ' Title[/table_column] ';
				d += '[table_cell] content goes here..[/table_cell] ';
			
			} // End FOR Loop
			
			h += '[/table_columns]';
			d += '[/table_row][/table_content]';
			
			g += h+d+ '[/table_wrap]';

			return g
		
		}
};