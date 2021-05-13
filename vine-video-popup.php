<?php
/*
Plugin Name: Video Popup
Description: Allows creating popups with video as easy as pie.
Version: 1.1
Author: Viktor Novikov
Author URI: http://v-novicov.pro/
*/
?>
<?php

define('VINE_PURL', plugin_dir_url( __FILE__ ));

add_action('wp', function(){
	if (function_exists('get_field') && !empty(get_field( 'videos_popup' ))) {
		wp_enqueue_style( 'magnific-popup', VINE_PURL.'assets/dist/Magnific-Popup-master/magnific-popup.css' );
		wp_enqueue_style( 'plyr', VINE_PURL.'assets/dist/plyr-master/plyr.css' );
		wp_enqueue_style( 'vp-style', VINE_PURL.'assets/styles.css' );
		wp_enqueue_script( 'magnific-popup', VINE_PURL.'assets/dist/Magnific-Popup-master/jquery.magnific-popup.min.js', [], false, true );
		wp_enqueue_script( 'plyr', VINE_PURL.'assets/dist/plyr-master/plyr.js', [], false, true );
		wp_enqueue_script( 'vp-script', VINE_PURL.'assets/scripts.js', ['jquery', 'magnific-popup', 'plyr'], false, true );
	}
});

add_action( 'wp_enqueue_scripts', function() {
	wp_localize_script( 'vp-script', 'vp_page_videos', get_field( 'videos_popup' ) );
} );

add_action('wp_footer', function(){
	if (function_exists('get_field') && !empty(get_field( 'videos_popup' ))) {
?>
<div id="vp-video-popup" class="mfp-hide"></div>
<?php
	}
});

add_shortcode( 'pvid', function($attrs){
	return '#vp-video-'.$attrs['id'];
} );
add_shortcode( 'pvid_class', function($attrs){
	return '.vp-video-'.$attrs['id'];
} );

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5fa3ba3a14dab',
	'title' => 'Popup Videos',
	'fields' => array(
		array(
			'key' => 'field_5fa3bb73cfd95',
			'label' => '',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Create Videos and use them as shortcodes:
&bull; <b>[pvid id="X"]</b> as href attribute of <code>&lt;a /&gt;</code> tag;
&bull; <b>[pvid_class id="X"]</b> as class attribute of any HTML element.',
			'new_lines' => 'br',
			'esc_html' => 0,
		),
		array(
			'key' => 'field_5fa3babecfd94',
			'label' => 'Videos',
			'name' => 'videos_popup',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5fa3bc792be09',
					'label' => 'Type',
					'name' => 'type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '30',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Self-hosted' => 'Self-hosted',
						'YouTube' => 'YouTube',
						'Vimeo' => 'Vimeo',
					),
					'default_value' => false,
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 1,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5fa3bcaa2be0a',
					'label' => 'Video',
					'name' => 'video',
					'type' => 'group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '70',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5fa3bcd62be0b',
							'label' => 'Video File',
							'name' => 'video_file',
							'type' => 'file',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5fa3bc792be09',
										'operator' => '==',
										'value' => 'Self-hosted',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'library' => 'all',
							'min_size' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5fa3bd1a2be0c',
							'label' => 'Poster',
							'name' => 'poster',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5fa3bc792be09',
										'operator' => '==',
										'value' => 'Self-hosted',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'medium',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5fa3bd2e2be0d',
							'label' => 'YouTube Video ID',
							'name' => 'youtube_video_id',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5fa3bc792be09',
										'operator' => '==',
										'value' => 'YouTube',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5fa3bd736b26d',
							'label' => 'Vimeo Video ID',
							'name' => 'vimeo_video_id',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5fa3bc792be09',
										'operator' => '==',
										'value' => 'Vimeo',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
					),
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'case-study',
			),
		),
	),
	'menu_order' => 20,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
?>