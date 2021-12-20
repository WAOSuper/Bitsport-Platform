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
class Testimonial extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_testimonial';
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
		return esc_html__( 'Testimonial', 'appway' );
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
			'testimonial',
			[
				'label' => esc_html__( 'Testimonial', 'appway' ),
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
						[
						  'name' => 'block_image1',
						  'label' => __( 'Image', 'rashid' ),
						  'type' => Controls_Manager::MEDIA,
						  'default' => ['url' => Utils::get_placeholder_image_src(),],
						],
						[
							'name' => 'block_text1',
							'label' => esc_html__('Text', 'rashid'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'rashid')
						],
						[
							'name' => 'block_title1',
							'label' => esc_html__('Title', 'rashid'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'rashid')
						],
						[
							'name' => 'block_subtitle1',
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
			
    <!-- testimonial-section -->
    <section class="testimonial-section centred">
        <div class="image-layer" style="background-image: url(<?php echo esc_url($settings['bgimg']['url']);?>);"></div>
        <div class="container">
            <div class="sec-title center">
                <h2><?php echo $settings['title'];?></h2>
                <p><?php echo $settings['text'];?></p>
            </div>
            <div class="testimonial-carousel owl-carousel owl-theme">
			
				<?php foreach($settings['repeat'] as $item):?>	
			
                <div class="testimonial-inner">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 testimonial-block">
                            <div class="testimonial-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="<?php echo esc_url($item['block_image']['url']);?>" alt="<?php esc_attr_e('Image', 'rashid'); ?>	"></figure>
                                    <div class="text"><?php echo wp_kses($item['block_text'], $allowed_tags);?></div>  
                                    <div class="author-info">
                                        <h5 class="name"><?php echo wp_kses($item['block_title'], $allowed_tags);?></h5>
                                        <span class="designation"><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 testimonial-block">
                            <div class="testimonial-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="<?php echo esc_url($item['block_image1']['url']);?>" alt="<?php esc_attr_e('Image', 'rashid'); ?>	"></figure>
                                    <div class="text"><?php echo wp_kses($item['block_text1'], $allowed_tags);?></div>  
                                    <div class="author-info">
                                        <h5 class="name"><?php echo wp_kses($item['block_title1'], $allowed_tags);?></h5>
                                        <span class="designation"><?php echo wp_kses($item['block_subtitle1'], $allowed_tags);?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php endforeach; ?>
				
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->

		<?php 
	}

}

