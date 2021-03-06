<?php

class PS_Elementor_Widget extends \Elementor\Widget_Base
{
    /**
     * Returns the name of the widget.
     *
     * @return string
     */
    public function get_name()
    {
        return 'passster';
    }
    
    /**
     * Returns the title of the widget.
     *
     * @return string
     */
    public function get_title()
    {
        return __( 'Passster', 'content-protector' );
    }
    
    /**
     * Returns the icon of the widget.
     *
     * @return string
     */
    public function get_icon()
    {
        return 'fa fa-code';
    }
    
    /**
     * Add widget to category.
     *
     * @return array
     */
    public function get_categories()
    {
        return [ 'basic' ];
    }
    
    /**
     * Register controls for Passster widget.
     *
     * @return void
     */
    protected function _register_controls()
    {
        $args = array(
            'post_type'      => 'password_lists',
            'posts_per_page' => -1,
        );
        $lists = get_posts( $args );
        $choosable_lists = array();
        if ( isset( $lists ) && !empty($lists) ) {
            foreach ( $lists as $list ) {
                $choosable_lists[$list->ID] = $list->post_title;
            }
        }
        $this->start_controls_section( 'passster_section', [
            'label' => __( 'Passster', 'content-protector' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ] );
        $this->add_control( 'passster_protect_options', [
            'label'     => __( 'Protection', 'content-protector' ),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'passster_type', [
            'label'   => __( 'Protection Type', 'content-protector' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'password',
            'options' => [
            'password' => __( 'Password', 'content-protector' ),
            'captcha'  => __( 'Captcha', 'content-protector' ),
        ],
        ] );
        $this->add_control( 'passster_password', [
            'label'       => __( 'Password', 'content-protector' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'placeholder' => __( 'Enter your password', 'content-protector' ),
        ] );
        $this->add_control( 'passster_api', [
            'label'       => __( 'API', 'content-protector' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'placeholder' => __( 'Enter your API', 'content-protector' ),
        ] );
        $this->add_control( 'passster_style_options', [
            'label'     => __( 'Texts', 'content-protector' ),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'passster_headline', [
            'label'   => __( 'Headline', 'content-protector' ),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => get_theme_mod( 'passster_form_instructions_headline', __( 'Protected Area', 'content-protector' ) ),
        ] );
        $this->add_control( 'passster_placeholder', [
            'label'   => __( 'Input Placeholder', 'content-protector' ),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => get_theme_mod( 'passster_form_instructions_placeholder', __( 'Enter your password..', 'content-protector' ) ),
        ] );
        $this->add_control( 'passster_button_label', [
            'label'   => __( 'Button Label', 'content-protector' ),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => get_theme_mod( 'passster_form_button_label', __( 'Submit', 'content-protector' ) ),
        ] );
        $this->add_control( 'passster_instructions', [
            'label'   => __( 'Instructions Text', 'content-protector' ),
            'type'    => \Elementor\Controls_Manager::TEXTAREA,
            'rows'    => 10,
            'default' => get_theme_mod( 'passster_form_instructions_text', __( 'This content is password-protected. Please verify with a password to unlock the content.', 'content-protector' ) ),
        ] );
        $this->add_control( 'passster_protected_content_headline', [
            'label'     => __( 'Protected Content', 'content-protector' ),
            'type'      => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'passster_protected_content', [
            'label'   => __( 'Protected Content', 'content-protector' ),
            'type'    => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __( 'This content is your protected content', 'content-protector' ),
        ] );
        $this->end_controls_section();
    }
    
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $shortcode = '';
        switch ( $settings['passster_type'] ) {
            case 'password':
                $shortcode .= '[passster password="' . $settings['passster_password'] . '"';
                break;
            case 'captcha':
                $shortcode .= '[passster captcha="true"';
                break;
            case 'recaptcha':
                $shortcode .= '[passster recaptcha="true"]';
                break;
            case 'passwords':
                $shortcode .= '[passster passwords="' . $settings['passster_passwords'] . '"';
                break;
            case 'password_list':
                $shortcode .= '[passster password_list="' . $settings['passster_password_list'] . '"';
                break;
        }
        if ( !empty($settings['passster_headline']) ) {
            $shortcode .= ' headline="' . $settings['passster_headline'] . '"';
        }
        if ( !empty($settings['passster_api']) ) {
            $shortcode .= ' api="' . $settings['passster_api'] . '"';
        }
        if ( !empty($settings['passster_placeholder']) ) {
            $shortcode .= ' placeholder="' . $settings['passster_placeholder'] . '"';
        }
        if ( !empty($settings['passster_button_label']) ) {
            $shortcode .= ' button="' . $settings['passster_button_label'] . '"';
        }
        if ( !empty($settings['passster_instructions']) ) {
            $shortcode .= ' instruction="' . $settings['passster_instructions'] . '"';
        }
        if ( !empty($settings['passster_protected_content']) ) {
            $shortcode .= ' elementor-protected-content="' . $settings['passster_protected_content'] . '"';
        }
        $shortcode .= ']';
        echo  do_shortcode( $shortcode . $settings['passster_protected_content'] . '[/passster]' ) ;
    }
    
    /**
     * Render shortcode in elementor view.
     *
     * @return void
     */
    protected function _content_template()
    {
        ?>
		<div class="passster-form">  
			<form class="password-form" method="post" autocomplete="off" target="_top">
				<h4>{{{ settings.passster_headline }}}</h4>
				<p>{{{ settings.passster_instructions }}}</p>
				<fieldset>
				<input placeholder="{{{ settings.passster_placeholder }}}" type="password" tabindex="1" name="passster_password" class="passster-password" autocomplete="off" data-protection-type="password" data-password="{{{ settings.passster_password }}}" data-partly="" data-list="" data-protection="">
				<span class="password-typing"></span>
				<button name="submit" type="submit" class="passster-submit" data-psid="" data-submit="...Checking Password">{{{ settings.passster_button_label }}}</button>
				<div class="passster-error"></div>
				</fieldset>
			</form>
		</div>
		<?php 
    }

}