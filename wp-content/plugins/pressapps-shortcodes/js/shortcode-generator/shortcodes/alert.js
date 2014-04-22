gpShortcodeMeta={
	attributes:[
		{
			label:"Type",
			id:"type", 
		//	help:"info,success,danger",
			controlType:"select-control", 
			selectLabelValues:[{'Warning':'warning'},{'Info':'info'}, {'Success':'success'}, {'Danger':'danger'}],
			defaultValue: 'info', 
			defaultText: 'Info', 
		},
		{
			label:"Close",
			id:"close",
			help:"Display close link",
			controlType:"select-control", 
			selectLabelValues:[{'True':'true'}, {'No':'no'}],
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
		shortcode:"alert"
};
