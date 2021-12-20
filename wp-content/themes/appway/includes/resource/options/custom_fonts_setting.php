<?php


return array(

	'title'  => esc_html__( 'Custom Font Settings', 'appway' ),

	'id'     => 'custom_fonts_setting',

	'desc'   => '',

	'icon'   => 'el el-font',

	'fields' => array(

		array(
			'id'   => 'theme_custom_font',

			'type' => 'fonts',

			'desc' => esc_html__( 'Please upload your desire font file in *.ttf,  *.otf, *.eot, *.woff format', 'appway' ),
		),
	),    
);
