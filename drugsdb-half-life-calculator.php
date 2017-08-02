<?php
/*
Plugin Name: Drugsdb Half-Life Calculator
Plugin URI: http://shinraholdings.com/plugins/drugsdb-half-life-calc
Description: Get the known half-life for your drug from Drugsdb.
Version: 1.1
Author: drugsdb, bitacre
Author URI: http://drugsdb.com
License: GPLv3
	Copyright 2012 Drugsdb (http://drugsdb.com)
*/

class drugsdbHalfLife extends WP_Widget {

// constructor
function drugsdbHalfLife() { 
	// set widget options
	$widget_ops = array ( 
		'classname' => 'drugsdbHalfLife',
		'description' => 'Get the known half-life for your drug.'
	); 
	// extend class
	$this->WP_Widget( 'drugsdbHalfLife', 'Half-Life Calculator', $widget_ops );
}


// draw widget options
function form( $instance ) { 
	$defaults = array(
		'title' => 'Drug Half Life Calculator',
		'attrib' => ''
	);
	
	$instance = wp_parse_args( ( array ) $instance, $defaults );
	
	$slug = 'title';
	printf( '<!-- %1$s -->
		<p>
			<label for="%2$s">%3$s: </label>
			<input class="widefat" id="%4$s" name="%2$s" type="text" value="%5$s" />
		</p>',
			$slug,
			$this->get_field_name( $slug ),
			'Title',
			$this->get_field_id( $slug ),
			esc_attr( $instance[$slug] )
		);
	
	$slug = 'attrib';
	printf( '<!-- %1$s -->
		<p>
			<label for="%2$s">%3$s</label>
			<input id="%4$s" name="%2$s" type="checkbox" value="1" %5$s />
		</p>',
			$slug,
			$this->get_field_name( $slug ),
			'Remove Drugsdb attribution?',
			$this->get_field_id( $slug ),
			checked( $instance[$slug], 1, false )
		);
}

// SAVE WIDGET OPTIONS
function update( $new_instance, $old_instance) {
	$instance = $old_instance;
	$options = array('title', 'attrib');
	
	foreach( $options as $slug )
		$instance[$slug] = $new_instance[$slug];

	return $instance;
}

// ACTUAL WIDGET OUTPUT
function widget( $args, $instance ) { 
   	extract( $args, EXTR_SKIP ); // extract arguments
	
//	$half_lives = $this->getHLs();
	echo $before_widget; // insert pre-widget code (from theme)
	echo $before_title . $instance['title'] . $after_title; // echo title (inside theme tags)
		/* 
		<p>
		<select id="drugsdb-drug-name" name="drugsdb-drug-name" onfocus="drugsdbHide();">
			<option value="custom">[Enter a Half-life]</option>
			<?php foreach( $half_lives as $drug_name=>$coeff ) { ?><option value="<?php echo $coeff; ?>"><?php echo $drug_name; ?></option><?php } ?>
		</select>
		</p>
		*/ ?>
		<div>
			<label for="drugsdb-dosage" style="position:relative; float: left; width:45%; margin: 0 12px 6px 0;">Dosage: </label>
			<input id="drugsdb-dosage" name="drugsdb-dosage" type="text" style="width: 50px; float: left;" onfocus="drugsdbHideSidebar();"/>
			<span id="drugsdb-units-mg" class="drugsdb-units" style="float: left; padding-left: 2px;" >mg</span>
			<div style="clear:both; height:1px; visibility:hidden;"></div>
		</div>

		<div>
			<label for="drugsdb-custom-hl" style="position:relative; float: left; width:45%; margin: 0 12px 6px 0;">Half-life: </label>
			<input id="drugsdb-custom-hl" name="drugsdb-custom-hl" type="text" style="width: 50px; float: left;" onfocus="drugsdbHideSidebar();" />
			<span id="drugsdb-units-hours" class="drugsdb-units" style="float: left; padding-left: 2px;" >hours</span>
			<div style="clear:both; height:1px; visibility:hidden;"></div>
			<?php if( !$instance['attrib'] ) { ?><!--<span id="dbdrugs-attribution" class="dbdrugs-attribution" style="font-size:0.9em;">Find the known half-life for your medication at <a href="http://www.drugsdb.com">Drugsdb.com</a></span>--><?php } ?>

		</div>

		<p><input id="drugsdb-submit" name="drugsdb-submit" type="button" value="Calculate" onclick="drugsdbSubmitCustomSidebar();" />&nbsp;<span id="drugsdb-result" class="drugsdb-result" style="display: none; padding-left:20px;">NaN</span></p>
	<?php echo $after_widget; 
}
// end class
}

function drugsdbHalfLife_shortcode( $atts, $content='' ) { 
	extract( shortcode_atts( array( 'remove_attrib'=>'no' ), $atts ) );
	$output = 
'	<div style="max-width: 300px; border: 1px solid #000; padding: 5px; margin:5 px;">
		<div>
			<label for="drugsdb-dosage-shortcode" style="position:relative; float: left; width:45%; margin: 0 12px 6px 0;">Dosage: </label>
			<input id="drugsdb-dosage-shortcode" name="drugsdb-dosage" type="text" style="width: 50px; float: left;" onfocus="drugsdbHideShortcode();"/>
			<span id="drugsdb-units-mg-shortcode" class="drugsdb-units" style="float: left; padding-left: 2px;" >mg</span>
			<div style="clear:both; height:1px; visibility:hidden;"></div>
		</div>
		
		<div>
			<label for="drugsdb-custom-hl-shortcode" style="position:relative; float: left; width:45%; margin: 0 12px 6px 0;">Half-life: </label>
			<input id="drugsdb-custom-hl-shortcode" name="drugsdb-custom-hl-shortcode" type="text" style="width: 50px; float: left;" onfocus="drugsdbHideShortcode();" />
			<span id="drugsdb-units-hours-shortcode" class="drugsdb-units" style="float: left; padding-left: 2px;" >hours</span>
			<div style="clear:both; height:1px; visibility:hidden;"></div>
			' . ( $remove_attrib!='yes' ? '<span id="dbdrugs-attribution-shortcode" class="dbdrugs-attribution" style="font-size:0.9em;">Find the known half-life for your medication at <!--<a href="http://www.drugsdb.com">Drugsdb.com</a></span>-->' : '' ) . '
		</div>

		<p><input id="drugsdb-submit-shortcode" name="drugsdb-submit-shortcode" type="button" value="Calculate" onclick="drugsdbSubmitCustomShortcode();" />&nbsp;<span id="drugsdb-result-shortcode" class="drugsdb-result-shortcode" style="display: none; padding-left:20px;">NaN</span></p>
	</div>';
return $output;
	
}
// ADD HOOKS AND FILTERS
add_action( 'widgets_init', create_function( '', 'register_widget("drugsdbHalfLife" );' ) ); // register widget
add_action( 'wp_enqueue_scripts', create_function( '', 'wp_enqueue_script( "drugsdbHalfLife-sidebar", trailingslashit( plugins_url() ) . "drugsdb-half-life-calc/drugsdb-half-life-calc-sidebar.js" );' ) );
add_action( 'wp_enqueue_scripts', create_function( '', 'wp_enqueue_script( "drugsdbHalfLife-shortcode", trailingslashit( plugins_url() ) . "drugsdb-half-life-calc/drugsdb-half-life-calc-shortcode.js" );' ) );
// add_action( 'plugins_loaded', create_function( '', 'load_plugin_textdomain( "drugsdbHalfLife", null,  trailingslashit( basename(dirname(__FILE__) ) ) . "lang" );' ) );
add_shortcode( 'halflife', 'drugsdbHalfLife_shortcode' );
?>