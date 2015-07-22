<?php
/**
 * Predefined Fields for use with the Advanced Custom Fields plugin
 * 
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_55439a7e8a79d',
	'title' => 'Layout Options',
	'fields' => array (
		array (
			'key' => 'field_55439ac8e4556',
			'label' => 'Remove Entry Header Block',
			'name' => 'remove_entry_header',
			'prefix' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => 'tf-block',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5543a04ae4557',
			'label' => 'Override Page Title?',
			'name' => 'hide_title',
			'prefix' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_55439ac8e4556',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => 'tf-block',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5543a0fce4558',
			'label' => 'Entry Header Content',
			'name' => 'custom_header',
			'prefix' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5543a04ae4557',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_55439ac8e4556',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;
