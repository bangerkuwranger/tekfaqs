wooShortcodeMeta={
	attributes:[
		{
			label:"Optional URL to Like",
			id:"url",
			help:"Optionally place the URL you want viewers to 'Like' here. Defaults to the page/post URL."
		}, 
		{
			label:"Style",
			id:"style",
			help:"Values: standard, button_count, box_count (default: standard).<p>Note: Depending on how fast the Facebook API is today, the preview could take a few moments to load.</p>",
			controlType:"select-control", 
			selectLabelValues:[{'Standard':'standard'}, {'Button_count':'button_count'}, {'Box_count':'box_count'}],
			defaultValue: 'standard', 
			defaultText: 'Standard (Default)'
		}, 
		{
			label:"Float",
			id:"float",
			help:"Float left, right, or none.",
			controlType:"select-control", 
			selectLabelValues:[{'Left':'left'}, {'Right':'right'}],
			defaultValue: '', 
			defaultText: 'None (Default)'
		}, 
		{
			label:"Show Faces",
			id:"showfaces",
			help:"Show the faces of Facebook users who 'like' your URL.",
			controlType:"select-control", 
			selectLabelValues:[{'False':'false'}, {'True':'true'}],
			defaultValue: 'false', 
			defaultText: 'False (Default)'
		}, 
		{
			label:"Width",
			id:"width",
			help:"Set the width of this button.", 
			defaultValue: '450'
		}, 
		{
			label:"Verb to display",
			id:"verb",
			help:"The verb to display with this button.",
			controlType:"select-control", 
			selectLabelValues:[{'Like':'like'}, {'Recommend':'recommend'}],
			defaultValue: 'like', 
			defaultText: 'Like (Default)'
		}, 
		{
			label:"Font",
			id:"font",
			help:"The font to use when displaying this button.",
			controlType:"select-control", 
			selectLabelValues:[{'Arial':'arial'},{'Lucida grande':'lucida grande'},{'Segoe ui':'segoe ui'},{'Tahoma':'tahoma'},{'Trebuchet ms':'trebuchet ms'},{'Verdana':'verdana'}],
			defaultValue: 'arial', 
			defaultText: 'Arial (Default)'
		}, 
		],
		defaultContent:"",
		shortcode:"fblike"
};