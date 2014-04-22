gpShortcodeMeta={
	attributes:[
		{
			label:"Tooltip",
			id:"tip",
			isRequired:true
		},
		{
			label:"Content",
			id:"content",
			controlType: 'textarea-control',
			help: 'Use a &lt;br /&gt; to start a new line.',
			isRequired:true
		},
		{
			label:"Url",
			id:"url",
			help:"E.g. http://pressapps.co/",
		},
		{
			label:"Placement",
			id:"placement",
			controlType:"select-control", 
			selectLabelValues:[{'Top':'top'},{'Left':'left'},{'Right':'right'},{'Bottom':'bottom'}],
		//	help:"The button title.",
			defaultValue: 'top', 
			defaultText: 'Top'
		}
		],
		shortcode:"tooltip"
};