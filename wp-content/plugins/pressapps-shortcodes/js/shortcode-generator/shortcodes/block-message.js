gpShortcodeMeta={
	attributes:[
		{
			label:"Type",
			id:"type", 
		//	help:"info,success,error",
			controlType:"select-control", 
			selectLabelValues:[{'Info':'info'},{'Warning':'warning'},{'Success':'success'},{'Danger':'danger'}],
			defaultValue: 'info',
			defaultText : 'Info'
		},
		{
			label:"Close",
			id:"close",
			help:"Display close link",
			controlType:"select-control", 
			selectLabelValues:[{'True':'true'},{'No':'no'}],
			defaultValue: 'true', 
			defaultText: 'Yes'
		},
		{
			label:"Text",
			id:"text",
			help:"Message",
			controlType:"textarea-control",
		}
		],
		shortcode:"block-message"
};
