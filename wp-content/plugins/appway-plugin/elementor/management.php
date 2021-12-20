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
class Management extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_management';
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
		return esc_html__( 'Management', 'appway' );
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
			'management',
			[
				'label' => esc_html__( 'Management', 'appway' ),
			]
		);
		
		$this->add_control(
			'image',
				[
				  'label' => __( 'Image', 'rashid' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);
		
		$this->add_control(
			'image1',
				[
				  'label' => __( 'Image', 'rashid' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
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
			'bttn',
			[
				'label'       => __( 'Button', 'rashid' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'rashid' ),
			]
		);	
		
		$this->add_control(
			'bttn1',
			[
				'label'       => __( 'Button', 'rashid' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'rashid' ),
			]
		);
		
		$this->add_control(
			'bttn2',
			[
				'label'       => __( 'Button', 'rashid' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'rashid' ),
			]
		);


		$this->end_controls_section();
		
	// New Tab#1

	$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Tab 1', 'rashid' ),
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
		
	// New Tab#2

	$this->start_controls_section(
				'content_section1',
				[
					'label' => __( 'Tab 2', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
              'repeat1', 
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
	
	// New Tab#3

	$this->start_controls_section(
				'content_section2',
				[
					'label' => __( 'Tab 3', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
              'repeat2', 
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

          
           
    <!-- management-section -->
    <section class="management-section centred">
        <div class="pattern-bg">
            <div class="pattern-1" style="background-image: url(<?php echo wp_get_attachment_url($settings['image']['id']);?>);"></div>
            <div class="pattern-2" style="background-image: url(<?php echo wp_get_attachment_url($settings['image1']['id']);?>);"></div>
        </div>
        <div class="container">
            <div class="sec-title center">
                <h2><?php echo $settings['title'];?></h2>
            </div>
            <div class="tabs-box">
                <div class="tab-btn-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><?php echo $settings['bttn'];?></li>
                        <li class="tab-btn" data-tab="#tab-2"><?php echo $settings['bttn1'];?></li>
                        <li class="tab-btn" data-tab="#tab-3"><?php echo $settings['bttn2'];?></li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="single-item-carousel owl-carousel owl-theme">
						
							<?php foreach($settings['repeat'] as $item):?>
						
							<?php if(wp_get_attachment_url($item['block_image']['id'])): ?>
                            <figure class="image-box"><a href="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle'], $allowed_tags);?>"></a></figure>
							<?php endif; ?>
							
							<?php endforeach; ?>
							
                        </div>
                    </div>
                    <div class="tab" id="tab-2">
                        <div class="single-item-carousel owl-carousel owl-theme">
						
                            <?php foreach($settings['repeat1'] as $item):?>
						
                            <?php if(wp_get_attachment_url($item['block_image']['id'])): ?>
							<figure class="image-box"><a href="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle'], $allowed_tags);?>"></a></figure>
							<?php endif; ?>
							
							<?php endforeach; ?>
							
                        </div>
                    </div>
                    <div class="tab" id="tab-3">
                        <div class="single-item-carousel owl-carousel owl-theme">
						
                            <?php foreach($settings['repeat2'] as $item):?>
						
                            <?php if(wp_get_attachment_url($item['block_image']['id'])): ?>
							<figure class="image-box"><a href="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle'], $allowed_tags);?>"></a></figure>
							<?php endif; ?>
							
							<?php endforeach; ?>
							
                        </div>
                    </div>           
                </div>
            </div>
        </div>
    </section>
    <!-- management-section end -->
            
		<?php 
	}

}
