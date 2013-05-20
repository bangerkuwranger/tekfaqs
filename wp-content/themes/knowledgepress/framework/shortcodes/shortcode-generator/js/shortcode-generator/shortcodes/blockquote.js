wooShortcodeMeta={
	attributes:[
		{
			label:"Content",
			id:"content",
			controlType: 'textarea-control',
			help: 'Use a &lt;br /&gt; to start a new line.',
			isRequired:true
		},
		{
			label:"Float",
			id:"float",
			help:"Float left or right.", 
			controlType:"select-control", 
			selectLabelValues:[{'Left':'left'},{'Right':'right'}],
			defaultValue: 'left', 
			defaultText: 'Left'
		},
		{
			label:"Cite",
			id:"cite",
			help:"Text for cite",
		}
		],
		shortcode:"blockquote"
};
