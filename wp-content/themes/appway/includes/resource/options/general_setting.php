<?php
$styles = [];
foreach(range(1, 28) as $val) {
    $styles[$val] = sprintf(esc_html__('Style %s', 'appway'), $val);
}

return  array(
    'title'      => esc_html__( 'General Setting', 'appway' ),
    'id'         => 'general_setting',
    'desc'       => '',
    'icon'       => 'el el-wrench',
    'fields'     => array(
        array(
            'id' => 'theme_color_scheme',
            'type' => 'color',
            'output' => array('.site-title'),
            'title' => esc_html__('Color Scheme', 'appway'),
            'default' => '#4527a4',
            'transparent' => false
        ),
        array(
            'id' => 'theme_preloader',
            'type' => 'switch',
            'title' => esc_html__('Enable Preloader', 'appway'),
            'default' => true,
        ),
        array(
            'id' => 'theme_rtl',
            'type' => 'switch',
            'title' => esc_html__('Enable RTL', 'appway'),
            'default' => false,
        ),
        array(
            'id' => 'theme_scroll',
            'type' => 'switch',
            'title' => esc_html__('Hide Scroll to Top', 'appway'),
            'default' => true,
        ),
		
    ),
);
