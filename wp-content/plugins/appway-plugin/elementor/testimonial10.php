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
class Testimonial10 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_testimonial10';
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
		return esc_html__( 'Testimonial 10', 'appway' );
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
			'testimonial10',
			[
				'label' => esc_html__( 'Testimonial 10', 'appway' ),
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
					'bgimg',
					[
						'label' => esc_html__('Background image', 'rashid'),
						'type' => Controls_Manager::MEDIA,
						'default' => ['url' => Utils::get_placeholder_image_src(),],
					]
				);
				
				$this->add_control(
					'bgimg1',
					[
						'label' => esc_html__('Background image', 'rashid'),
						'type' => Controls_Manager::MEDIA,
						'default' => ['url' => Utils::get_placeholder_image_src(),],
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
				$this->add_control(
					'image4',
						[
						  'label' => __( 'Image', 'rashid' ),
						  'type' => Controls_Manager::MEDIA,
						  'default' => ['url' => Utils::get_placeholder_image_src(),],
						]
				);
				$this->add_control(
					'imgtitle4',
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
					'image5',
						[
						  'label' => __( 'Image', 'rashid' ),
						  'type' => Controls_Manager::MEDIA,
						  'default' => ['url' => Utils::get_placeholder_image_src(),],
						]
				);
				$this->add_control(
					'imgtitle5',
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
					'image6',
						[
						  'label' => __( 'Image', 'rashid' ),
						  'type' => Controls_Manager::MEDIA,
						  'default' => ['url' => Utils::get_placeholder_image_src(),],
						]
				);
				$this->add_control(
					'imgtitle6',
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
					'image7',
						[
						  'label' => __( 'Image', 'rashid' ),
						  'type' => Controls_Manager::MEDIA,
						  'default' => ['url' => Utils::get_placeholder_image_src(),],
						]
				);
				$this->add_control(
					'imgtitle7',
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
						'label' => __( 'Testimonials Block', 'rashid' ),
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
								'name' => 'block_rating',
								'label'   => esc_html__( 'Select Rating', 'rashid' ),
								'type'    => Controls_Manager::SELECT,
								'default' => '1',
								'options' => array(
									'rat1'   => esc_html__( 'Rating One', 'rashid' ),
									'rat2'   => esc_html__( 'Rating Two', 'rashid' ),
									'rat3'   => esc_html__( 'Rating Three', 'rashid' ),
									'rat4'   => esc_html__( 'Rating Four', 'rashid' ),
									'rat5'   => esc_html__( 'Rating Five', 'rashid' ),
								),
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
			
    <!-- testimonial-style-ten -->
    <section class="testimonial-style-ten">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-12 col-md-12 user-column">
                    <div class="user-thumb">
                        <div class="thumb-box">
                            
							
							<div class="pattern-bg1" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg']['id']);?>);"></div>
							
							
							
                            <div class="pattern-bg2" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg1']['id']);?>);"></div>
                            
							<?php if(wp_get_attachment_url($settings['image']['id'])): ?>
							<figure class="thumb thumb-1"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo $settings['imgtitle'];?>"></figure>
							<?php endif; ?>
							
							<?php if(wp_get_attachment_url($settings['image1']['id'])): ?>
                            <figure class="thumb thumb-2"><img src="<?php echo wp_get_attachment_url($settings['image1']['id']);?>" alt="<?php echo $settings['imgtitle1'];?>"></figure>
							<?php endif; ?>
							
							<?php if(wp_get_attachment_url($settings['image2']['id'])): ?>
                            <figure class="thumb thumb-3"><img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo $settings['imgtitle2'];?>"></figure>
							<?php endif; ?>
							
							<?php if(wp_get_attachment_url($settings['image3']['id'])): ?>
                            <figure class="thumb thumb-4"><img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo $settings['imgtitle3'];?>"></figure>
							<?php endif; ?>
							
							<?php if(wp_get_attachment_url($settings['image4']['id'])): ?>
                            <figure class="thumb thumb-5"><img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo $settings['imgtitle4'];?>"></figure>
							<?php endif; ?>
							
							<?php if(wp_get_attachment_url($settings['image5']['id'])): ?>
                            <figure class="thumb thumb-6"><img src="<?php echo wp_get_attachment_url($settings['image5']['id']);?>" alt="<?php echo $settings['imgtitle5'];?>"></figure>
							<?php endif; ?>
							
							<?php if(wp_get_attachment_url($settings['image6']['id'])): ?>
                            <figure class="thumb thumb-7"><img src="<?php echo wp_get_attachment_url($settings['image6']['id']);?>" alt="<?php echo $settings['imgtitle6'];?>"></figure>
							
							<?php endif; ?>
							<?php if(wp_get_attachment_url($settings['image7']['id'])): ?>
                            <figure class="thumb thumb-8"><img src="<?php echo wp_get_attachment_url($settings['image7']['id']);?>" alt="<?php echo $settings['imgtitle7'];?>"></figure>
							<?php endif; ?>
							
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 content-column">
                    <div class="content-box">
                        <div class="sec-title"><h2><?php echo $settings['title'];?></h2></div>
                        <div class="testimonial-carousel-2 owl-carousel owl-theme">
						
							<?php foreach($settings['repeat'] as $item):?>
						
                            <div class="testimonial-content">
                                <div class="inner-box">
                                    <div class="text"><?php echo wp_kses($item['block_text'], $allowed_tags);?></div>
                                    <div class="author-info">
                                        <ul class="rating clearfix">
                                            <?php  if ( 'rat1' === $item['block_rating'] ) : ?>      
												<li><i class="fas fa-star"></i></li>
											<?php endif ;?>	         
											<?php  if ( 'rat2' === $item['block_rating'] ) : ?>      
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
											<?php endif ;?>
											<?php  if ( 'rat3' === $item['block_rating'] ) : ?>      
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
											<?php endif ;?>	   
											<?php  if ( 'rat4' === $item['block_rating'] ) : ?>      
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
											<?php endif ;?>	
											<?php  if ( 'rat5' === $item['block_rating'] ) : ?>      
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
												<li><i class="fas fa-star"></i></li>
											<?php endif ;?>
                                        </ul>
                                        <h4 class="name"><?php echo wp_kses($item['block_title'], $allowed_tags);?></h4>
                                        <span class="designation"><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
                                    </div>
                                </div>
                            </div>
							
							<?php endforeach; ?>
							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-style-ten end -->

		<?php 
	}

}

