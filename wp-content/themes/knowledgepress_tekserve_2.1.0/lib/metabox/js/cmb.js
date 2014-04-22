/**
 * Controls the behaviours of custom metabox fields.
 *
 * @author Andrew Norcross
 * @author Jared Atchison
 * @author Bill Erickson
 * @author Justin Sternberg
 * @see    https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

/*jslint browser: true, devel: true, indent: 4, maxerr: 50, sub: true */
/*global jQuery, tb_show, tb_remove */

/**
 * Custom jQuery for Custom Metaboxes and Fields
 */
jQuery(document).ready(function ($) {
	'use strict';

	var formfield;

	/**
	 * Initialize timepicker (this will be moved inline in a future release)
	 */
	$('.cmb_timepicker').each(function () {
		$('#' + jQuery(this).attr('id')).timePicker({
			startTime: "07:00",
			endTime: "22:00",
			show24Hours: false,
			separator: ':',
			step: 30
		});
	});

	/**
	 * Initialize jQuery UI datepicker (this will be moved inline in a future release)
	 */
	$('.cmb_datepicker').each(function () {
		$('#' + jQuery(this).attr('id')).datepicker();
		// $('#' + jQuery(this).attr('id')).datepicker({ dateFormat: 'yy-mm-dd' });
		// For more options see http://jqueryui.com/demos/datepicker/#option-dateFormat
	});
	// Wrap date picker in class to narrow the scope of jQuery UI CSS and prevent conflicts
	$("#ui-datepicker-div").wrap('<div class="cmb_element" />');

	/**
	 * Initialize color picker
	 */
	if (typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function') {
		$('input:text.cmb_colorpicker').wpColorPicker();
	} else {
		$('input:text.cmb_colorpicker').each(function (i) {
			$(this).after('<div id="picker-' + i + '" style="z-index: 1000; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>');
			$('#picker-' + i).hide().farbtastic($(this));
		})
		.focus(function () {
			$(this).next().show();
		})
		.blur(function () {
			$(this).next().hide();
		});
	}

	/**
	 * File and image upload handling
	 */
	$('.cmb_upload_file').change(function () {
		formfield = $(this).attr('name');
		$('#' + formfield + '_id').val("");
	});

	$('.cmb_upload_button').live('click', function () {
		var buttonLabel;
		formfield = $(this).prev('input').attr('name');
		buttonLabel = 'Use as ' + $('label[for=' + formfield + ']').text();
		tb_show('', 'media-upload.php?post_id=' + $('#post_ID').val() + '&type=file&cmb_force_send=true&cmb_send_label=' + buttonLabel + '&TB_iframe=true');
		return false;
	});

	$('.cmb_remove_file_button').live('click', function () {
		formfield = $(this).attr('rel');
		$('input#' + formfield).val('');
		$('input#' + formfield + '_id').val('');
		$(this).parent().remove();
		return false;
	});

	window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function (html) {
		var itemurl, itemclass, itemClassBits, itemid, htmlBits, itemtitle,
			image, uploadStatus = true;

		if (formfield) {

	        if ($(html).html(html).find('img').length > 0) {
				itemurl = $(html).html(html).find('img').attr('src'); // Use the URL to the size selected.
				itemclass = $(html).html(html).find('img').attr('class'); // Extract the ID from the returned class name.
				itemClassBits = itemclass.split(" ");
				itemid = itemClassBits[itemClassBits.length - 1];
				itemid = itemid.replace('wp-image-', '');
	        } else {
				// It's not an image. Get the URL to the file instead.
				htmlBits = html.split("'"); // jQuery seems to strip out XHTML when assigning the string to an object. Use alternate method.
				itemurl = htmlBits[1]; // Use the URL to the file.
				itemtitle = htmlBits[2];
				itemtitle = itemtitle.replace('>', '');
				itemtitle = itemtitle.replace('</a>', '');
				itemid = ""; // TO DO: Get ID for non-image attachments.
			}

			image = /(jpe?g|png|gif|ico)$/gi;

			if (itemurl.match(image)) {
				uploadStatus = '<div class="img_status"><img src="' + itemurl + '" alt="" /><a href="#" class="cmb_remove_file_button" rel="' + formfield + '">Remove Image</a></div>';
			} else {
				// No output preview if it's not an image
				// Standard generic output if it's not an image.
				html = '<a href="' + itemurl + '" target="_blank" rel="external">View File</a>';
				uploadStatus = '<div class="no_image"><span class="file_link">' + html + '</span>&nbsp;&nbsp;&nbsp;<a href="#" class="cmb_remove_file_button" rel="' + formfield + '">Remove</a></div>';
			}

			$('#' + formfield).val(itemurl);
			$('#' + formfield + '_id').val(itemid);
			$('#' + formfield).siblings('.cmb_media_status').slideDown().html(uploadStatus);
			tb_remove();

		} else {
			window.original_send_to_editor(html);
		}

		formfield = '';
	};

	/**
	 * Ajax oEmbed display
	 */

	// ajax on paste
	$('.cmb_oembed').bind('paste', function (e) {
		var pasteitem = $(this);
		// paste event is fired before the value is filled, so wait a bit
		setTimeout(function () {
			// fire our ajax function
			doCMBajax(pasteitem, 'paste');
		}, 100);
	}).blur(function () {
		// when leaving the input
		setTimeout(function () {
			// if it's been 2 seconds, hide our spinner
			$('.postbox table.cmb_metabox .cmb-spinner').hide();
		}, 2000);
	});

	// ajax when typing
	$('.cmb_metabox').on('keyup', '.cmb_oembed', function (event) {
		// fire our ajax function
		doCMBajax($(this), event);
	});

	// function for running our ajax
	function doCMBajax(obj, e) {
		// get typed value
		var oembed_url = obj.val();
		// only proceed if the field contains more than 6 characters
		if (oembed_url.length < 6)
			return;

		// only proceed if the user has pasted, pressed a number, letter, or whitelisted characters
		if (e === 'paste' || e.which <= 90 && e.which >= 48 || e.which >= 96 && e.which <= 111 || e.which == 8 || e.which == 9 || e.which == 187 || e.which == 190) {

			// get field id
			var field_id = obj.attr('id');
			// get our inputs context for pinpointing
			var context = obj.parents('.cmb_metabox tr td');
			// show our spinner
			$('.cmb-spinner', context).show();
			// clear out previous results
			$('.embed_wrap', context).html('');
			// and run our ajax function
			setTimeout(function () {
				// if they haven't typed in 500 ms
				if ($('.cmb_oembed:focus').val() == oembed_url) {
					$.ajax({
						type : 'post',
						dataType : 'json',
						url : window.ajaxurl,
						data : {
							'action': 'cmb_oembed_handler',
							'oembed_url': oembed_url,
							'field_id': field_id,
							'post_id': window.cmb_ajax_data.post_id,
							'cmb_ajax_nonce': window.cmb_ajax_data.ajax_nonce
						},
						success: function (response) {
							// if we have a response id
							if (typeof response.id !== 'undefined') {
								// hide our spinner
								$('.cmb-spinner', context).hide();
								// and populate our results from ajax response
								$('.embed_wrap', context).html(response.result);
							}
						}
					});
				}
			}, 500);
		}
	}

	// Post formats
	$(function()
	{
		$("#video_metabox").hide();

	// post formats
		$('#post-format-0').click(function()
		{
			$("#video_metabox").hide();
		});
		$('#post-format-image').click(function()
		{
			$("#video_metabox").hide();
		});
		$('#post-format-video').click(function()
		{
			$("#video_metabox").show();
		});

		if ( $("#post-format-video").attr("checked") == "checked" )
		{
			$("#video_metabox").show();
		}

	});
	// End post formats

	// Home page template 2
	$(function()
	{
		if($("#_boxes").val()==3){

			$(".cmb_id__boxes_title").show();
			$(".cmb_id__boxes_subtitle").show();

			$(".cmb_id__box_left").show();
			$(".cmb_id__box_icon_left").show();
			$(".cmb_id__box_icon_color_left").show();
			$(".cmb_id__box_title_left").show();
			$(".cmb_id__box_link_left").show();
			$(".cmb_id__box_content_left").show();

			$(".cmb_id__box_middle").show();
			$(".cmb_id__box_icon_middle").show();
			$(".cmb_id__box_icon_color_middle").show();
			$(".cmb_id__box_title_middle").show();
			$(".cmb_id__box_link_middle").show();
			$(".cmb_id__box_content_middle").show();

			$(".cmb_id__box_right").show();
			$(".cmb_id__box_icon_right").show();
			$(".cmb_id__box_icon_color_right").show();
			$(".cmb_id__box_title_right").show();
			$(".cmb_id__box_link_right").show();
			$(".cmb_id__box_content_right").show();

		} else if($("#_boxes").val()==2){

			$(".cmb_id__boxes_title").show();
			$(".cmb_id__boxes_subtitle").show();

			$(".cmb_id__box_left").show();
			$(".cmb_id__box_icon_left").show();
			$(".cmb_id__box_icon_color_left").show();
			$(".cmb_id__box_title_left").show();
			$(".cmb_id__box_link_left").show();
			$(".cmb_id__box_content_left").show();

			$(".cmb_id__box_middle").hide();
			$(".cmb_id__box_icon_middle").hide();
			$(".cmb_id__box_icon_color_middle").hide();
			$(".cmb_id__box_title_middle").hide();
			$(".cmb_id__box_link_middle").hide();
			$(".cmb_id__box_content_middle").hide();

			$(".cmb_id__box_right").show();
			$(".cmb_id__box_icon_right").show();
			$(".cmb_id__box_icon_color_right").show();
			$(".cmb_id__box_title_right").show();
			$(".cmb_id__box_link_right").show();
			$(".cmb_id__box_content_right").show();

		} else {

			$(".cmb_id__boxes_title").hide();
			$(".cmb_id__boxes_subtitle").hide();

			$(".cmb_id__box_left").hide();
			$(".cmb_id__box_icon_left").hide();
			$(".cmb_id__box_icon_color_left").hide();
			$(".cmb_id__box_title_left").hide();
			$(".cmb_id__box_link_left").hide();
			$(".cmb_id__box_content_left").hide();

			$(".cmb_id__box_middle").hide();
			$(".cmb_id__box_icon_middle").hide();
			$(".cmb_id__box_icon_color_middle").hide();
			$(".cmb_id__box_title_middle").hide();
			$(".cmb_id__box_link_middle").hide();
			$(".cmb_id__box_content_middle").hide();

			$(".cmb_id__box_right").hide();
			$(".cmb_id__box_icon_right").hide();
			$(".cmb_id__box_icon_color_right").hide();
			$(".cmb_id__box_title_right").hide();
			$(".cmb_id__box_link_right").hide();
			$(".cmb_id__box_content_right").hide();

		}

		$("#_boxes").on('change',function(){

			if($(this).val() == "2"){

				$(".cmb_id__boxes_title").show();
				$(".cmb_id__boxes_subtitle").show();

				$(".cmb_id__box_left").show();
				$(".cmb_id__box_icon_left").show();
				$(".cmb_id__box_icon_color_left").show();
				$(".cmb_id__box_title_left").show();
				$(".cmb_id__box_link_left").show();
				$(".cmb_id__box_content_left").show();

				$(".cmb_id__box_middle").hide();
				$(".cmb_id__box_icon_middle").hide();
				$(".cmb_id__box_icon_color_middle").hide();
				$(".cmb_id__box_title_middle").hide();
				$(".cmb_id__box_link_middle").hide();
				$(".cmb_id__box_content_middle").hide();

				$(".cmb_id__box_right").show();
				$(".cmb_id__box_icon_right").show();
				$(".cmb_id__box_icon_color_right").show();
				$(".cmb_id__box_title_right").show();
				$(".cmb_id__box_link_right").show();
				$(".cmb_id__box_content_right").show();

			}else if($(this).val() == "3"){

				$(".cmb_id__boxes_title").show();
				$(".cmb_id__boxes_subtitle").show();

				$(".cmb_id__box_left").show();
				$(".cmb_id__box_icon_left").show();
				$(".cmb_id__box_icon_color_left").show();
				$(".cmb_id__box_title_left").show();
				$(".cmb_id__box_link_left").show();
				$(".cmb_id__box_content_left").show();

				$(".cmb_id__box_middle").show();
				$(".cmb_id__box_icon_middle").show();
				$(".cmb_id__box_icon_color_middle").show();
				$(".cmb_id__box_title_middle").show();
				$(".cmb_id__box_link_middle").show();
				$(".cmb_id__box_content_middle").show();

				$(".cmb_id__box_right").show();
				$(".cmb_id__box_icon_right").show();
				$(".cmb_id__box_icon_color_right").show();
				$(".cmb_id__box_title_right").show();
				$(".cmb_id__box_link_right").show();
				$(".cmb_id__box_content_right").show();

			}else if($(this).val() == "0"){

				$(".cmb_id__boxes_title").hide();
				$(".cmb_id__boxes_subtitle").hide();

				$(".cmb_id__box_left").hide();
				$(".cmb_id__box_icon_left").hide();
				$(".cmb_id__box_icon_color_left").hide();
				$(".cmb_id__box_title_left").hide();
				$(".cmb_id__box_link_left").hide();
				$(".cmb_id__box_content_left").hide();

				$(".cmb_id__box_middle").hide();
				$(".cmb_id__box_icon_middle").hide();
				$(".cmb_id__box_icon_color_middle").hide();
				$(".cmb_id__box_title_middle").hide();
				$(".cmb_id__box_link_middle").hide();
				$(".cmb_id__box_content_middle").hide();

				$(".cmb_id__box_right").hide();
				$(".cmb_id__box_icon_right").hide();
				$(".cmb_id__box_icon_color_right").hide();
				$(".cmb_id__box_title_right").hide();
				$(".cmb_id__box_link_right").hide();
				$(".cmb_id__box_content_right").hide();

			}
		});



	});
	// End home page template 2

});