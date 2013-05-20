wooShortcodeMeta={
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
			selectLabelValues:[{'Primary':'btn-primary'},{'Info':'btn-info'},{'Success':'btn-success'}, {'Danger':'btn-danger'},{'Warning':'btn-warning'}, {'Inverse':'btn-inverse'}]
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