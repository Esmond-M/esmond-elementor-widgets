<?php
declare(strict_types=1);
namespace includes\classes\emNavMenuElementor;

if (!class_exists('emNavMenuElementor_class')) {
    class emNavMenuElementor_class extends \Elementor\Widget_Base
    {
    private $display_menu_id;

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data , $args );

		$theme_version = EMCLIENT_Theme_VERSION;
		$nonCache_version = rand( 1, 99999999999 );
		// Enqueue Main style.
		wp_enqueue_style( 'emClient-elementor-menu-css', get_stylesheet_directory_uri() . '/assets/css/elementor-menu.css', array(), $nonCache_version );

    }
    
    public function get_name() {
        return 'emClient-menu';
    }

    public function get_title() {
        return __( 'EM Client Menu', 'emClient-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['general'];
    }

    private function get_menus() {
        $menus = wp_get_nav_menus();

        $menu_list = [];

  

        foreach ( $menus as $menu ) {
            $menu_list[ $menu->slug ] = $menu->name;
        }

        return $menu_list;
    }

    private function get_default_slug() {
        $menu = $this->get_menus();

        return key( $menu );
    }

    public function register_controls() {
        $this->start_controls_section(
            'menu_selection',
            [
                'label' => __( 'Menu Selection', 'emClient-elementor-widgets' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu',
            [
                'label'   => __( 'Select Menu', 'emClient-elementor-widgets' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_menus(),
                'default' => $this->get_default_slug(),
                'label_block' => false,
            ]
        );

        $this->end_controls_section();

   
        $this->start_controls_section(
            'menu_selection_style',
            [
                'label' => __( 'Menu Style', 'emClient-elementor-widgets' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __( 'Background Color', 'emClient-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .emClient-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'menu_text_color',
            [
                'label'     => __( 'Link Color', 'emClient-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .emClient-menu a:link' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'menu_text_color_hover',
            [
                'label'     => __( 'Link Hover Color', 'emClient-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .emClient-menu a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_text_font_family',
            [
                'label'     => __( 'Font Family', 'emClient-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::FONT,
                'default'   => "'Open Sans', san-serif",
                'selectors' => [
                    '{{WRAPPER}} .emClient-menu' => 'font-family: "{{VALUE}}"',
                ],
            ]
        );

        $this->add_control(
            'menu_display_style',
            [
                'label'   => __( 'Display Style', 'emClient-elementor-widgets' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'block'        => 'Block',
                    'inline'       => 'Inline',
                    'inline-block' => 'Inline Block',
                    'flex'         => 'Flex',
                    'inline-flex'  => 'Inline Flex',
                ],
                'default' => 'inline-block',
                'selectors' => [
                    '{{WRAPPER}} .emClient-menu a' => 'display: {{VALUE}}',
                ],
            ],
        );


        $this->add_control(
            'link_margin',
            [
                'label'     => __( 'Link Margin', 'emClient-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => 0,
                        'max'  => 5,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .emClient-menu a' => 'margin: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function get_style_depends() {
        return ['emClient-elementor-menu-css'];
    }

    // front end.
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->display_menu_id = $settings['menu'];

        echo wp_nav_menu(
            array(
                'menu'       => $this->display_menu_id,
                'container'  => '',
                'menu_class' => 'emClient-menu',
            )
        );
    }

    // Back end.
    protected function content_template() {

        echo wp_nav_menu(
            array(
                'menu'       => $this->display_menu_id,
                'container'  => '',
                'menu_class' => 'emClient-menu',
            )
        );
    }
    
} // Closing bracket for class

}
    use includes\classes\emNavMenuElementor;