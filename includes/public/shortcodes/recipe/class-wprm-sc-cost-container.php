<?php
/**
 * Handle the recipe cost container shortcode.
 *
 * @link       http://bootstrapped.ventures
 * @since      5.2.0
 *
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/includes/public/shortcodes/recipe
 */

/**
 * Handle the recipe cost container shortcode.
 *
 * @since      5.2.0
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/includes/public/shortcodes/recipe
 * @author     Brecht Vandersmissen <brecht@bootstrapped.ventures>
 */
class WPRM_SC_Cost_Container extends WPRM_Template_Shortcode {
	public static $shortcode = 'wprm-recipe-cost-container';

	public static function init() {
		self::$attributes = array(
			'id' => array(
				'default' => '0',
			),
			'style' => array(
				'default' => 'separate',
				'type' => 'dropdown',
				'options' => array(
					'inline' => 'Inline',
					'separate' => 'On its own line',
					'separated' => 'On separate lines',
					'columns' => 'Columns',
				),
			),
			'text_style' => array(
				'default' => 'normal',
				'type' => 'dropdown',
				'options' => 'text_styles',
			),
			'icon' => array(
				'default' => '',
				'type' => 'icon',
			),
			'icon_color' => array(
				'default' => '#333333',
				'type' => 'color',
				'dependency' => array(
					'id' => 'icon',
					'value' => '',
					'type' => 'inverse',
				),
			),
			'label' => array(
				'default' => '',
				'type' => 'text',
			),
			'label_separator' => array(
				'default' => ' ',
				'type' => 'text',
			),
			'label_style' => array(
				'default' => 'normal',
				'type' => 'dropdown',
				'options' => 'text_styles',
			),
		);
		parent::init();
	}

	/**
	 * Output for the shortcode.
	 *
	 * @since	5.2.0
	 * @param	array $atts Options passed along with the shortcode.
	 */
	public static function shortcode( $atts ) {
		$atts = parent::get_attributes( $atts );

		$recipe = WPRM_Template_Shortcodes::get_recipe( $atts['id'] );
		$cost = WPRM_SC_Cost::shortcode( $atts );
		if ( ! $cost ) {
			return '';
		}

		// Get optional icon.
		$icon = '';
		if ( $atts['icon'] ) {
			$icon = WPRM_Icon::get( $atts['icon'], $atts['icon_color'] );

			if ( $icon ) {
				$icon = '<span class="wprm-recipe-icon wprm-recipe-cost-icon">' . $icon . '</span> ';
			}
		}

		// Get optional label.
		$label = '';
		if ( $atts['label'] ) {
			$label = '<span class="wprm-recipe-details-label wprm-block-text-' . $atts['label_style'] . ' wprm-recipe-cost-label">' . __( $atts['label'], 'wp-recipe-maker' ) . $atts['label_separator'] . '</span>';
		}

		// Output.
		$classes = array(
			'wprm-recipe-cost-container',
			'wprm-recipe-block-container',
			'wprm-recipe-block-container-' . $atts['style'],
			'wprm-block-text-' . $atts['text_style'],
		);

		$output = '<div class="' . implode( ' ', $classes ) . '">';
		$output .= $icon;
		$output .= $label;
		$output .= $cost;
		$output .= '</div>';

		return apply_filters( parent::get_hook(), $output, $atts, $recipe );
	}
}

WPRM_SC_Cost_Container::init();