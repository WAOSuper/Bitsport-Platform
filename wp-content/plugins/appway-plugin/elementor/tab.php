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
class Tab extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_tab';
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
		return esc_html__( 'Tab', 'appway' );
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
			'tab',
			[
				'label' => esc_html__( 'Tab', 'appway' ),
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
		
		$this->add_control(
			'bttn3',
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
					'title1',
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
					'text1',
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
					'text2',
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
					'bttn4',
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
				'btnlink',
				[
				  'label' => __( 'Button Url', 'rashid' ),
				  'type' => Controls_Manager::URL,
				  'placeholder' => __( 'https://your-link.com', 'rashid' ),
				  'show_external' => true,
				  'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				  ],
				
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
				'imgtitle',
				[
					'label'       => __( 'Image Texts', 'rashid' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your Image Texts', 'rashid' ),
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
					'title2',
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
					'text3',
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
					'text4',
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
					'bttn5',
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
				'btnlink1',
				[
				  'label' => __( 'Button Url', 'rashid' ),
				  'type' => Controls_Manager::URL,
				  'placeholder' => __( 'https://your-link.com', 'rashid' ),
				  'show_external' => true,
				  'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				  ],
				
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
				'imgtitle1',
				[
					'label'       => __( 'Image Texts', 'rashid' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your Image Texts', 'rashid' ),
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
					'title3',
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
					'text5',
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
					'text6',
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
					'bttn6',
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
				'btnlink2',
				[
				  'label' => __( 'Button Url', 'rashid' ),
				  'type' => Controls_Manager::URL,
				  'placeholder' => __( 'https://your-link.com', 'rashid' ),
				  'show_external' => true,
				  'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				  ],
				
			   ]
			);
			
			$this->add_control(
				'image2',
					[
					  'label' => __( 'Image', 'rashid' ),
					  'type' => Controls_Manager::MEDIA,
					  'default' => ['url' => Utils::get_placeholder_image_src(),],
					]
			);
			$this->add_control(
				'imgtitle2',
				[
					'label'       => __( 'Image Texts', 'rashid' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your Image Texts', 'rashid' ),
				]
			);	
		$this->end_controls_section();
		
		// New Tab#4

		$this->start_controls_section(
					'content_section3',
					[
						'label' => __( 'Tab 4', 'rashid' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);
				
				$this->add_control(
					'title4',
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
					'text7',
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
					'text8',
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
					'bttn7',
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
				'btnlink3',
				[
				  'label' => __( 'Button Url', 'rashid' ),
				  'type' => Controls_Manager::URL,
				  'placeholder' => __( 'https://your-link.com', 'rashid' ),
				  'show_external' => true,
				  'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				  ],
				
			   ]
			);
			
			$this->add_control(
				'image3',
					[
					  'label' => __( 'Image', 'rashid' ),
					  'type' => Controls_Manager::MEDIA,
					  'default' => ['url' => Utils::get_placeholder_image_src(),],
					]
			);
			$this->add_control(
				'imgtitle3',
				[
					'label'       => __( 'Image Texts', 'rashid' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your Image Texts', 'rashid' ),
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

          
           
    <!-- designe-process-two -->
    <section class="designe-process-two">
        <div class="container">
            <div class="sec-title center">
                <h2><?php echo $settings['title'];?></h2>
                <p><?php echo $settings['text'];?></p>
            </div>
            <div class="tabs-box">
                <div class="tab-btn-box centred">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><?php echo $settings['bttn'];?></li>
                        <li class="tab-btn" data-tab="#tab-2"><?php echo $settings['bttn1'];?></li>
                        <li class="tab-btn" data-tab="#tab-3"><?php echo $settings['bttn2'];?></li>
                        <li class="tab-btn" data-tab="#tab-4"><?php echo $settings['bttn3'];?></li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                                <div class="content-box">
                                    <h3><?php echo $settings['title1'];?></h3>
                                    <div class="text">
                                        <p><?php echo $settings['text1'];?></p>
                                        <p><?php echo $settings['text2'];?></p>
                                    </div>
                                    <div class="btn-box"><a href="<?php echo esc_url($settings['btnlink']['url']);?>" class="theme-btn-two"><?php echo $settings['bttn4'];?></a></div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                                
								<?php if(wp_get_attachment_url($settings['image']['id'])): ?>
								<div class="image-box">
                                    <figure class="image animated slideInRight"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo $settings['imgtitle'];?>"></figure>
                                </div>
								<?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab-2">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                                <div class="content-box">
                                    <h3><?php echo $settings['title2'];?></h3>
                                    <div class="text">
                                        <p><?php echo $settings['text2'];?></p>
                                        <p><?php echo $settings['text3'];?></p>
                                    </div>
                                    <div class="btn-box"><a href="<?php echo esc_url($settings['btnlink1']['url']);?>" class="theme-btn-two"><?php echo $settings['bttn5'];?></a></div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                                
								<?php if(wp_get_attachment_url($settings['image1']['id'])): ?>
								<div class="image-box">
                                    <figure class="image animated slideInRight"><img src="<?php echo wp_get_attachment_url($settings['image1']['id']);?>" alt="<?php echo $settings['imgtitle1'];?>"></figure>
                                </div>
								<?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab-3">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                                <div class="content-box">
                                    <h3><?php echo $settings['title3'];?></h3>
                                    <div class="text">
                                        <p><?php echo $settings['text4'];?></p>
                                        <p><?php echo $settings['text5'];?></p>
                                    </div>
                                    <div class="btn-box"><a href="<?php echo esc_url($settings['btnlink2']['url']);?>" class="theme-btn-two"><?php echo $settings['bttn6'];?></a></div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                                
								<?php if(wp_get_attachment_url($settings['image2']['id'])): ?>
								<div class="image-box">
                                    <figure class="image animated slideInRight"><img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo $settings['imgtitle2'];?>"></figure>
                                </div>
								<?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab-4">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                                <div class="content-box">
                                    <h3><?php echo $settings['title4'];?></h3>
                                    <div class="text">
                                        <p><?php echo $settings['text5'];?></p>
                                        <p><?php echo $settings['text6'];?></p>
                                    </div>
                                    <div class="btn-box"><a href="<?php echo esc_url($settings['btnlink3']['url']);?>" class="theme-btn-two"><?php echo $settings['bttn7'];?></a></div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                                
								<?php if(wp_get_attachment_url($settings['image3']['id'])): ?>
								<div class="image-box">
                                    <figure class="image animated slideInRight"><img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo $settings['imgtitle3'];?>"></figure>
                                </div>
								<?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- designe-process-two end -->
            
		<?php 
	}

}
