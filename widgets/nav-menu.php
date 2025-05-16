<?php
declare(strict_types=1);
namespace Esmond\ElementorWidgets\Widgets;

use Elementor\Widget_Base;

if (!class_exists('Nav_Menu;')) {
    class Nav_Menu extends Widget_Base
    {
    private $display_menu_id;

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data , $args );

		$theme_version = esmond_Theme_VERSION;
		$nonCache_version = rand( 1, 99999999999 );
		// Enqueue Main style.
		wp_enqueue_style( 'esmond-elementor-menu-css', get_stylesheet_directory_uri() . '/assets/css/elementor-menu.css', array(), $nonCache_version );

    }
    
    public function get_name() {
        return 'esmond-menu';
    }

    public function get_title() {
        return __( 'EM Nav Menu', 'esmond-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['esmond'];
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
                'label' => __( 'Menu Selection', 'esmond-elementor-widgets' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu',
            [
                'label'   => __( 'Select Menu', 'esmond-elementor-widgets' ),
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
                'label' => __( 'Menu Style', 'esmond-elementor-widgets' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __( 'Background Color', 'esmond-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .esmond-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'menu_text_color',
            [
                'label'     => __( 'Link Color', 'esmond-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .esmond-menu a:link' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'menu_text_color_hover',
            [
                'label'     => __( 'Link Hover Color', 'esmond-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .esmond-menu a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_text_font_family',
            [
                'label'     => __( 'Font Family', 'esmond-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::FONT,
                'default'   => "'Open Sans', san-serif",
                'selectors' => [
                    '{{WRAPPER}} .esmond-menu' => 'font-family: "{{VALUE}}"',
                ],
            ]
        );

        $this->add_control(
            'menu_display_style',
            [
                'label'   => __( 'Display Style', 'esmond-elementor-widgets' ),
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
                    '{{WRAPPER}} .esmond-menu a' => 'display: {{VALUE}}',
                ],
            ],
        );


        $this->add_control(
            'link_margin',
            [
                'label'     => __( 'Link Margin', 'esmond-elementor-widgets' ),
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
                    '{{WRAPPER}} .esmond-menu a' => 'margin: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function get_style_depends() {
        return ['esmond-elementor-menu-css'];
    }

    // front end.
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->display_menu_id = $settings['menu'];

        echo wp_nav_menu(
            array(
                'menu'       => $this->display_menu_id,
                'container'  => '',
                'menu_class' => 'esmond-menu',
            )
        );
    }

    // Back end.
    protected function content_template() {

        echo wp_nav_menu(
            array(
                'menu'       => $this->display_menu_id,
                'container'  => '',
                'menu_class' => 'esmond-menu',
            )
        );
    }
    
} // Closing bracket for class

}
