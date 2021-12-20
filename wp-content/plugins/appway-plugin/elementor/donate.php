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
class Donate extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_donate';
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
		return esc_html__( 'Donate', 'appway' );
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
			'donate',
			[
				'label' => esc_html__( 'Donate', 'appway' ),
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

		$this->end_controls_section();
		
		// New Tab#1

		$this->start_controls_section(
					'content_section',
					[
						'label' => __( 'Select Box', 'rashid' ),
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

          
           
    <!-- donate-section -->
    <section class="donate-section">
        <div class="pattern-box">
            
			<?php if(wp_get_attachment_url($settings['image']['id'])): ?>
			<div class="pattern-1"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo $settings['imgtitle'];?>"></div>
			<?php endif; ?>
			
			<?php if(wp_get_attachment_url($settings['image1']['id'])): ?>
            <div class="pattern-2"><img src="<?php echo wp_get_attachment_url($settings['image1']['id']);?>" alt="<?php echo $settings['imgtitle1'];?>"></div>
			<?php endif; ?>
			
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    
					<?php if(wp_get_attachment_url($settings['image2']['id'])): ?>
					<div id="image_block_46">
                        <figure class="image-box wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo $settings['imgtitle2'];?>"></figure>
                    </div>
					<?php endif; ?>
					
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_51">
                        <div class="content-box">
                            <div class="upper-box">
                                <h2><?php echo $settings['title'];?></h2>
                                <div class="text"><?php echo $settings['text'];?></div>
                                <div class="btn-box">
                                    <a href="<?php echo esc_url($settings['btnlink']['url']);?>" class="btn-one"><?php echo $settings['bttn'];?></a>
                                    <a href="<?php echo esc_url($settings['btnlink1']['url']);?>" class="btn-two"><?php echo $settings['bttn1'];?></a>
                                </div>
                            </div>
                            <div class="donation-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="select-box">
                                    <div class="text"><?php echo $settings['text1'];?></div>
                                    <select class="selectmenu">
                                        <option selected="selected"><?php echo $settings['text2'];?></option>
										
										<?php foreach($settings['repeat'] as $item):?>
										
                                        <option><?php echo wp_kses($item['block_title'], $allowed_tags);?></option>
										
										<?php endforeach; ?>
										
                                    </select>
                                </div>
                                <div class="btn-box">
                                    <a href="<?php echo esc_url($settings['btnlink2']['url']);?>"><?php echo $settings['bttn2'];?></a>
                                    <a href="<?php echo esc_url($settings['btnlink3']['url']);?>"><?php echo $settings['bttn3'];?></a>
                                    <button class="donate-box-btn"><?php echo $settings['bttn4'];?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- donate-section end -->
            
		<?php 
	}

}
