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
class Footer3 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_footer3';
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
		return esc_html__( 'Footer 3', 'appway' );
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
			'footer3',
			[
				'label' => esc_html__( 'Footer 3', 'appway' ),
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
		$this->add_control(
			'bgimg',
			[
				'label' => esc_html__('Background image', 'rashid'),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
		);

	$this->end_controls_section();	
	
	
	// New Tab#1

	$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Widget 01', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
				'number',
				[
					'label'   => esc_html__( 'Column', 'rashid' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 3,
					'min'     => 1,
					'max'     => 12,
					'step'    => 1,
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
				
			
			
	$this->end_controls_section();
	
	
	// New Tab#2

	$this->start_controls_section(
				'content_section1',
				[
					'label' => __( 'Widget 02', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
				'number1',
				[
					'label'   => esc_html__( 'Column', 'rashid' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 3,
					'min'     => 1,
					'max'     => 12,
					'step'    => 1,
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
								'name' => 'block_title',
								'label' => esc_html__('Title', 'rashid'),
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
					'label' => __( 'Widget 03', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
				'number2',
				[
					'label'   => esc_html__( 'Column', 'rashid' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 3,
					'min'     => 1,
					'max'     => 12,
					'step'    => 1,
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
				'feature_str',
				[
					'label'       => __( 'Features List', 'rashid' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your Features List', 'rashid' ),
					'default'     => __( '', 'rashid' ),
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
								'name' => 'block_icons',
								'label' => esc_html__('Enter The icons', 'rashid'),
								'type' => Controls_Manager::SELECT,
								'options'  => get_fontawesome_icons(),
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
	
	// New Tab#4

	$this->start_controls_section(
				'content_section3',
				[
					'label' => __( 'Widget 04', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control(
				'number3',
				[
					'label'   => esc_html__( 'Column', 'rashid' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 3,
					'min'     => 1,
					'max'     => 12,
					'step'    => 1,
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
								'name' => 'block_title',
								'label' => esc_html__('Title', 'rashid'),
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
	
	
	// New Tab#5

	$this->start_controls_section(
				'content_section4',
				[
					'label' => __( 'Copyright', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
              'repeat3', 
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
								'name' => 'block_title',
								'label' => esc_html__('Title', 'rashid'),
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
		
		
    <!-- main-footer -->
    <footer class="main-footer style-five  <?php echo $settings['sec_class'];?>">
        
		<?php if(wp_get_attachment_url($settings['image']['id'])): ?>
		<div class="anim-icons">
            <div class="icon icon-1"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo $settings['imgtitle'];?>"></div>
        </div>
		<?php endif; ?>
		
        <div class="image-layer" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg']['id']);?>);"></div>
        <div class="footer-top">
            <div class="container">
                <div class="widget-section">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($settings['number']);?> col-md-6 col-sm-12 footer-column">
                            <div class="about-widget footer-widget">
                                
								<?php if(wp_get_attachment_url($settings['image1']['id'])): ?>
								<figure class="footer-logo"><a href="index.html"><img src="<?php echo wp_get_attachment_url($settings['image1']['id']);?>" alt="<?php echo $settings['imgtitle1'];?>"></a></figure>
								<?php endif; ?>
								
                                <div class="text"><?php echo $settings['text'];?></div>
                                <h2 class="phone"><i class="fas fa-phone-volume"></i><a href="<?php echo esc_url($settings['btnlink']['url']);?>"><?php echo $settings['title'];?></a></h2>
                            </div>
                        </div>
                        <div class="col-lg-<?php echo esc_attr($settings['number1']);?> col-md-6 col-sm-12 footer-column">
                            <div class="links-widget footer-widget">
                                <h4 class="widget-title"><?php echo $settings['title1'];?></h4>
                                <div class="widget-content">
                                    <ul class="list clearfix">
									
                                        <?php foreach($settings['repeat'] as $item):?>
									
                                        <li><a href="<?php echo esc_url($item['block_btnlink']['url']);?>"><?php echo wp_kses($item['block_title'], $allowed_tags);?></a></li>
										
										<?php endforeach; ?>
										
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-<?php echo esc_attr($settings['number2']);?> col-md-6 col-sm-12 footer-column">
                            <div class="contact-widget footer-widget">
                                <h4 class="widget-title"><?php echo $settings['title2'];?></h4>
                                <div class="widget-content">
                                    <ul class="contact-info clearfix">
                                        <?php $fearures = explode("\n", ($settings['feature_str']));?>
										<?php foreach($fearures as $feature):?>
										<?php echo wp_kses($feature, true); ?>
										<?php endforeach; ?>
                                    </ul>
                                </div>
                                <ul class="social-links clearfix">
								
									<?php foreach($settings['repeat1'] as $item):?>
								
                                    <li><a href="<?php echo esc_url($item['block_btnlink']['url']);?>"><i class="<?php echo str_replace("fa ", "fab ", esc_attr( $item['block_icons']));?>"></i></a></li>
									
									<?php endforeach; ?>
									
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-<?php echo esc_attr($settings['number3']);?> col-md-6 col-sm-12 footer-column">
                            <div class="links-widget footer-widget">
                                <h4 class="widget-title"><?php echo $settings['title3'];?></h4>
                                <div class="widget-content">
                                    <ul class="list clearfix">
									
                                        <?php foreach($settings['repeat2'] as $item):?>
									
                                        <li><a href="<?php echo esc_url($item['block_btnlink']['url']);?>"><?php echo wp_kses($item['block_title'], $allowed_tags);?></a></li>
										
										<?php endforeach; ?>
										
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container clearfix">
                <div class="copyright pull-left"><?php echo $settings['text1'];?> <a href="<?php echo esc_url($settings['btnlink1']['url']);?>"><?php echo $settings['text2'];?></a>. <?php echo $settings['text3'];?></div>
                <ul class="footer-nav pull-right">
				
                    <?php foreach($settings['repeat3'] as $item):?>
									
					<li><a href="<?php echo esc_url($item['block_btnlink']['url']);?>"><?php echo wp_kses($item['block_title'], $allowed_tags);?></a></li>
					
					<?php endforeach; ?>
					
                </ul>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->
	
	
	
		<?php 
	}

}