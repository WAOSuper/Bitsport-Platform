<?php

return array(

    'title'         => esc_html__( 'Body Font Settings', 'appway' ),
    'id'            => 'body_font_setting',
    'desc'          => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id' => 'body_custom_fonts',
            'type' => 'switch',
            'title' => esc_html__('Use Body,Paragraph Custom Font', 'appway'),
            'desc' => esc_html__('Enable to customize the theme body,p tag font', 'appway'),
        ),
        array(
            'id' => 'body_typography',
            'type' => 'typography',
            'title' => esc_html__('Body Font Typography', 'appway'),
            'google' => true,
            'font-backup' => true,
            'output' => array('p', '.about > p', '.serv-caro li p ', '.counter-meta > p', '.funfacts > li > p', '.price-table p ', '.testimonials li p', '.ser-meta > p', '.whyus-meta > p ', '.touch-form > p ', '.category-box > p', '.experts-box .experts-box > p', '.blog-detail-meta > p', '.banner-meta > p', '.author-post > p', '.commenter-meta > p ', '.times > li p', '.complete-contact > p', '.xyz > p', '.error-page > p', '.project-deta .blog-detail-meta > p ', '.ziehharmonika > div p', '.download-box ul li p', '.soom-info > p ', '.countdown > li > p', '.s-not-found > p', '.about > p', '.serv-caro li p' ),
            'units' => 'px',
            'subtitle' => esc_html__('Apply options to customize the body,paragraph font for the theme', 'appway'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array('body_custom_fonts', '=', true),
        ),
    ),
);
