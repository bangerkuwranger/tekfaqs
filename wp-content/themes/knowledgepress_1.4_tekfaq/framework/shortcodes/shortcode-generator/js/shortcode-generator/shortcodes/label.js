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
			label:"Color",
			id:"color",
			controlType:"select-control", 
			selectLabelValues:[{'Grey':'grey'}, {'Green':'green'},{'Yellow':'yellow'} , {'Red':'red'}, {'Blue':'blue'},{'Black':'black'}],
		}
		],
		shortcode:"label"
};