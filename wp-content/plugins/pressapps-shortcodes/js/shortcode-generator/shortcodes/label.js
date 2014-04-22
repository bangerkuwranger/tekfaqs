gpShortcodeMeta={
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
			selectLabelValues:[{'Primary':'primary'},{'Default':'default'},{'Info':'info'},{'Success':'success'}, {'Danger':'danger'},{'Warning':'warning'}],
		}
		],
		shortcode:"label"
};