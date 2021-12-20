<?php

namespace APPWAYPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Designe extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_designe';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Designe', 'appway' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-briefcase';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'appway' ];
	}
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'designe',
			[
				'label' => esc_html__( 'Designe', 'appway' ),
			]
		);
		$this->add_control(
			'sec_class',
			[
				'label'       => __( 'Section Class', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Section Class', 'rashid' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'text',
			[
				'label'       => __( 'Description Text', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Description', 'rashid' ),
			]
		);
		$this->add_control(
			'tab',
			[
				'label'       => __( 'Tab', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Tab', 'rashid' ),
			]
		);
		$this->add_control(
			'tab1',
			[
				'label'       => __( 'Tab', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Tab', 'rashid' ),
			]
		);
		$this->add_control(
			'tab2',
			[
				'label'       => __( 'Tab', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Tab', 'rashid' ),
			]
		);
		$this->add_control(
			'tab3',
			[
				'label'       => __( 'Tab', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Tab', 'rashid' ),
			]
		);
		$this->end_controls_section();
		
			
	// New Tab#1

	$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Domain Name', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
              'repeat', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'seperator' => 'before',
            		'default' => 
						[
                			['block_title' => esc_html__('Projects Completed', 'rashid')],
            			],
            		'fields' => 
						[
							[
								'name' => 'block_id',
								'label' => esc_html__('Id', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'active',
								'label' => __( 'Show Area', 'rashid' ),
								'type' => \Elementor\Controls_Manager::SWITCHER,
								'label_on' => __( 'Show', 'rashid' ),
								'label_off' => __( 'Hide', 'rashid' ),
								'return_value' => 'yes',
								'default' => 'yes',
							],
							[
								'name' => 'block_title',
								'label' => esc_html__('Title', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_text',
								'label' => esc_html__('Text', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_button',
								'label'       => __( 'Button', 'rashid' ),
								'type'        => Controls_Manager::TEXT,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => __( 'Enter your Button Title', 'rashid' ),
								'default' => esc_html__('Read More', 'rashid'),
							],
							[
								'name' => 'block_bgimg',
								'label' => esc_html__('Background image', 'rashid'),
								'type' => Controls_Manager::MEDIA,
								'default' => ['url' => Utils::get_placeholder_image_src(),],
							],
							[
								'name' => 'block_bgimg1',
								'label' => esc_html__('Background image', 'rashid'),
								'type' => Controls_Manager::MEDIA,
								'default' => ['url' => Utils::get_placeholder_image_src(),],
							],
							[
								'name' => 'block_bgimg2',
								'label' => esc_html__('Background image', 'rashid'),
								'type' => Controls_Manager::MEDIA,
								'default' => ['url' => Utils::get_placeholder_image_src(),],
							],
							[
							  'name' => 'block_image',
							  'label' => __( 'Image', 'rashid' ),
							  'type' => Controls_Manager::MEDIA,
							  'default' => ['url' => Utils::get_placeholder_image_src(),],
							],
							[
								'name' => 'block_imgtitle',
								'label' => esc_html__('Image Text', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],	
							[
							  'name' => 'block_btnlink',
							  'label' => __( 'Button Url', 'rashid' ),
							  'type' => Controls_Manager::URL,
							  'placeholder' => __( 'https://your-link.com', 'rashid' ),
							  'show_external' => true,
							  'default' => [
								'url' => '',
								'is_external' => true,
								'nofollow' => true,
							  ],
							],
            			],
            	    'title_field' => '{{block_title}}',
                 ]
        );
			
	$this->end_controls_section();
		
		
		
		
	
	}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		?>
<section class="<?php echo esc_attr($settings['sec_class']);?> designe-process-two alternate-2 bg-color-1">
        <div class="container">
            <div class="sec-title center">
                <h2><?php echo $settings['title'];?></h2>
                <p><?php echo $settings['text'];?></p>
            </div>
            <div class="tabs-box">
                <div class="tab-btn-box centred">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><?php echo $settings['tab'];?></li>
                        <li class="tab-btn" data-tab="#tab-2"><?php echo $settings['tab1'];?></li>
                        <li class="tab-btn" data-tab="#tab-3"><?php echo $settings['tab2'];?></li>
                        <li class="tab-btn" data-tab="#tab-4"><?php echo $settings['tab3'];?></li>
                    </ul>
                </div>
                <div class="tabs-content">
                    
					<?php foreach($settings['repeat'] as $item):?>	
					
					<?php  if ( 'yes' === $item['active'] ) : ?>
					<div class="tab active-tab" id="tab-<?php echo wp_kses($item['block_id'], $allowed_tags);?>">
					<?php else: ?>
					<div class="tab" id="tab-<?php echo wp_kses($item['block_id'], $allowed_tags);?>">
					<?php endif; ?>
					
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                                <div class="content-box">
                                    <h3><?php echo wp_kses($item['block_title'], $allowed_tags);?></h3>
                                    <div class="text">
                                        <p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
                                    </div>
                                    
									<div class="btn-box"><a href="<?php echo esc_url($item['block_btnlink']['url']);?>" class="theme-btn-two"><?php echo wp_kses($item['block_button'], $allowed_tags);?></a></div>
									
									
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                                <div class="image-box">
                                    <div class="pattern-layer">
                                        <div class="pattern-1" style="background-image: url(<?php echo wp_get_attachment_url($item['block_bgimg']['id']);?>);"></div>
                                        <div class="pattern-2" style="background-image: url(<?php echo wp_get_attachment_url($item['block_bgimg1']['id']);?>);"></div>
                                        <div class="pattern-3" style="background-image: url(<?php echo wp_get_attachment_url($item['block_bgimg2']['id']);?>);"></div>
                                    </div>
                                    
									
									<?php if(wp_get_attachment_url($item['block_image']['id'])): ?>
									<figure class="image animated slideInRight"><img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle'], $allowed_tags);?>"></figure>
									<?php endif; ?>
									
                                </div>
                            </div>
                        </div>
                    </div>
                    
					<?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
		<?php 
	}

}
