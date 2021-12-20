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
class Testimonial11 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_testimonial11';
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
		return esc_html__( 'Testimonial 11', 'appway' );
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
			'testimonial11',
			[
				'label' => esc_html__( 'Testimonial 11', 'appway' ),
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
		
		$this->end_controls_section();
		
		// New Tab#1

		$this->start_controls_section(
					'content_section',
					[
						'label' => __( 'Image', 'rashid' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
					'bgimg',
					[
						'label' => esc_html__('Background image', 'rashid'),
						'type' => Controls_Manager::MEDIA,
						'default' => ['url' => Utils::get_placeholder_image_src(),],
					]
				);

				
				
		$this->end_controls_section();
		
		// New Tab#2

		$this->start_controls_section(
					'content_section1',
					[
						'label' => __( 'Testimonial Block', 'rashid' ),
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
								'name' => 'block_text',
								'label' => esc_html__('Text', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
							'name' => 'block_title',
							'label' => esc_html__('Title', 'rashid'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_subtitle',
								'label' => esc_html__('Subtitle', 'rashid'),
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
			
    <!-- testimonial-style-11 -->
    <section class="testimonial-style-11">
        <div class="anim-icons">
            
			<?php if(wp_get_attachment_url($settings['image']['id'])): ?>
			<div class="icon icon-1"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo $settings['imgtitle'];?>"></div>
			<?php endif; ?>
			
			<?php if(wp_get_attachment_url($settings['image1']['id'])): ?>
            <div class="icon icon-2"><img src="<?php echo wp_get_attachment_url($settings['image1']['id']);?>" alt="<?php echo $settings['imgtitle1'];?>"></div>
			<?php endif; ?>
			
			<?php if(wp_get_attachment_url($settings['image2']['id'])): ?>
            <div class="icon icon-3"><img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo $settings['imgtitle2'];?>"></div>
			<?php endif; ?>
			
        </div>
        <div class="container">
            <div class="inner-container">
                <div class="bg-layer" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg']['id']);?>);"></div>
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 title-column">
                        <div class="sec-title"><h2><?php echo $settings['title'];?></h2></div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                        <div class="testimonial-inner">
                            <div class="testimonial-carousel-3 owl-carousel owl-theme owl-dots-none">
							
								<?php foreach($settings['repeat'] as $item):?>
							
                                <div class="testimonial-content">
                                    
									<?php if(wp_get_attachment_url($item['block_image']['id'])): ?>
									<figure class="image-box"><img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle'], $allowed_tags);?>"></figure>
									<?php endif; ?>
									
                                    <div class="text"><?php echo wp_kses($item['block_text'], $allowed_tags);?></div>
                                    <div class="author-info">
                                        <h3 class="name"><?php echo wp_kses($item['block_title'], $allowed_tags);?></h3>
                                        <span class="designation"><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
                                    </div>
                                </div>
								
								<?php endforeach; ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-style-11 end -->

		<?php 
	}

}

