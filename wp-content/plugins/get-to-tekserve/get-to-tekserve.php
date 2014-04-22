<?php
/**
 * Plugin Name: Get to Tekserve
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Custom shortcode for Google Maps API 3 directions to Tekserve
 * Version: 1.0
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2013 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
//enqueue css & js
function gettotekserve_enqueue() {
	wp_enqueue_style( 'get-to-tekserve-style', plugins_url().'/get-to-tekserve/get-to-tekserve.css' );
	wp_enqueue_script( 'get-to-tekserve-js', plugins_url().'/get-to-tekserve/get-to-tekserve.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'gettotekserve_enqueue' );

function gettotekserve() {
	return '
	<div id="get-to-tekserve">
	<div id="panel">
		<div><b>Mode of Travel: </b></div>
		<select id="mode" style="margin-bottom: 1em;">
			<option value="DRIVING">Driving</option>
			<option value="WALKING">Walking</option>
			<option value="BICYCLING">Bicycling</option>
			<option value="TRANSIT">Transit</option>
		</select>
		<div><b>Starting Address: </b></div>
		<input id="start-address" type="textbox" value="">
		<input id="go-there" type="button" value="GO" onclick="codeStart();">
	</div>
	<div id="map-canvas"></div>
	<hr style="visibility: hidden; clear: both;"/>
	<div id="directions-panel"></div>
	</div>
	';
}

add_shortcode( 'get_to_tekserve', 'gettotekserve' );

function gettotekservedrawer() {
	return '
	<div class="drawer">
	<div id="get-to-tekserve" class="collapseomatic_content" style="display: none;">
	<div id="panel">
		<div><b>Mode of Travel: </b></div>
		<select id="mode" style="margin-bottom: 1em;">
			<option value="DRIVING">Driving</option>
			<option value="WALKING">Walking</option>
			<option value="BICYCLING">Bicycling</option>
			<option value="TRANSIT">Transit</option>
		</select>
		<div><b>Starting Address: </b></div>
		<input id="start-address" type="textbox" value="">
		<input id="go-there" type="button" value="GO" onclick="codeStart();">
	</div>
	<div id="map-canvas"></div>
	<hr style="visibility: hidden; clear: both;"/>
	<div id="directions-panel"></div>
	</div>
	</div>
	';
}

add_shortcode( 'get_to_tekserve_drawer', 'gettotekservedrawer' );