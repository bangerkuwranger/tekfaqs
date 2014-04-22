gpShortcodeMeta={
	attributes:[
		{
			label:"Hero Title",
			id:"hero_title",
			isRequired:true
		},
		{
			label:"Hero Button Type",
			id:"hero_button_type",
			controlType:"select-control",
			selectLabelValues:[{'Primary':'primary'},{'Default':'default'},{'Info':'info'},{'Success':'success'}, {'Danger':'danger'},{'Warning':'warning'}],
		},
		{
			label:"Hero Button Title",
			id:"hero_button_title",
			isRequired:true
		},
		{
			label:"Hero Button Link",
			id:"hero_button_link",
			help:"Enter button link URL",
			isRequired:true
		},
		{
			label:"Content",
			id:"content",
			controlType: 'textarea-control',
			help: 'Use a &lt;br /&gt; to start a new line.',
			isRequired:true
		}
		],
		shortcode:"hero"
};