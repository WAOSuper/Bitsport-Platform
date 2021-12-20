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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;
use Elementor\Utils;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Blog2 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_blog2';
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
		return esc_html__( 'Blog 2', 'appway' );
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
			'blog2',
			[
				'label' => esc_html__( 'Blog 2', 'appway' ),
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
			'imgtitle',
			[
				'label'       => __( 'Image Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Image Title', 'rashid' ),
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
				'placeholder' => esc_html__( 'Enter your Button Title', 'rashid' ),
				'default' => esc_html__('Read More', 'rashid'),
			]
		);
	$this->add_control(
			'column',
			[
				'label'   => esc_html__( 'Column', 'rashid' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 12,
				'step'    => 1,
			]
		);
$this->end_controls_section();
	
$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Blog Block', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			
		
		$this->add_control(
			'text_limit',
			[
				'label'   => esc_html__( 'Text Limit', 'appway' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 15,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_number',
			[
				'label'   => esc_html__( 'Number of post', 'appway' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_orderby',
			[
				'label'   => esc_html__( 'Order By', 'appway' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'       => esc_html__( 'Date', 'appway' ),
					'title'      => esc_html__( 'Title', 'appway' ),
					'menu_order' => esc_html__( 'Menu Order', 'appway' ),
					'rand'       => esc_html__( 'Random', 'appway' ),
				),
			]
		);
		$this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'appway' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESc' => esc_html__( 'DESC', 'appway' ),
					'ASC'  => esc_html__( 'ASC', 'appway' ),
				),
			]
		);
		$this->add_control(
			'query_exclude',
			[
				'label'       => esc_html__( 'Exclude', 'appway' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude posts, pages, etc. by ID with comma separated.', 'appway' ),
			]
		);
		$this->add_control(
            'query_category', 
				[
				  'type' => Controls_Manager::SELECT,
				  'label' => esc_html__('Category', 'appway'),
				  'options' => get_blog_categories()
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
        
        $paged = appway_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;

		$this->add_render_attribute( 'wrapper', 'class', 'templatepath-appway' );
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => appway_set( $settings, 'query_number' ),
			'orderby'        => appway_set( $settings, 'query_orderby' ),
			'order'          => appway_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		if ( appway_set( $settings, 'query_exclude' ) ) {
			$settings['query_exclude'] = explode( ',', $settings['query_exclude'] );
			$args['post__not_in']      = appway_set( $settings, 'query_exclude' );
		}
		if( appway_set( $settings, 'query_category' ) ) $args['category_name'] = appway_set( $settings, 'query_category' );
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) 
		{ ?>
	
	
    <!-- news-section -->
    <section class="news-section home-16 <?php echo $settings['sec_class'];?>">
		<div class="pattern-bg">
            <div class="pattern-1 wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg']['id']);?>);"></div>
            <div class="pattern-2 wow slideInRight" data-wow-delay="00ms" data-wow-duration="1500ms" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg1']['id']);?>);"></div>
        </div>
        <div class="container">
            <div class="sec-title center">
                <h2><?php echo $settings['title'];?></h2>
                <p><?php echo $settings['text'];?></p>
            </div>
            <div class="row">
			
				<?php while ( $query->have_posts() ) : $query->the_post();
					$meta_image = get_post_meta( get_the_id(), 'meta_image', true );
					?>
			
                <div class="col-lg-<?php echo esc_attr($settings['column'], true );?> col-md-6 col-sm-12 news-column">
                    <div class="news-block-one wow flipInY animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            
							
							<?php if($meta_image['id']): ?>
							<figure class="image-box"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><img src="<?php echo wp_get_attachment_url($meta_image['id']);?>" alt="<?php echo $settings['imgtitle'];?>"></a></figure>
							<?php endif; ?>
							
							
                            <div class="lower-content">
                                <div class="post-date"><i class="fas fa-calendar-alt"></i><?php echo get_the_date(); ?></div>
                                <h3><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h3>
                                
								<?php if($settings['bttn']):?>
								<div class="link-btn"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php echo $settings['bttn'];?></a></div>
								<?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php endwhile; ?>
				
            </div>
        </div>
    </section>
    <!-- news-section end -->
	
	
	
        <?php }
		wp_reset_postdata();
	}

}
