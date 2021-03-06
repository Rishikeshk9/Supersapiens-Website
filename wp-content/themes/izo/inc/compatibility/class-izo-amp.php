<?php
/**
 * Class to handle AMP compatibility
 *
 * @package Izo
 */


if ( !class_exists( 'Izo_AMP' ) ) :

	/**
	 * Izo_AMP 
	 */
	Class Izo_AMP {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {	
			add_filter( 'walker_nav_menu_start_el', array( $this, 'add_nav_sub_menu_buttons' ), 10, 2 );
			add_filter( 'izo_nav_data_attrs', array( $this, 'add_nav_attrs' ) );
			add_filter( 'izo_nav_toggle_data_attrs', array( $this, 'add_nav_toggle_attrs' ) );
		}

		public function add_nav_attrs( $input ) {
			if ( !izo_is_amp() ) {
				return $input;
			}
			$input .= ' [class]="( IzoMenuExpanded ? \'main-navigation toggled\' : \'main-navigation\' )" ';
			$input .= ' aria-expanded="false" [aria-expanded]="IzoMenuExpanded ? \'true\' : \'false\'" ';

			return $input;
		}


		public function add_nav_toggle_attrs( $input ) {
			if ( !izo_is_amp() ) {
				return $input;
			}

			$input .= ' on="tap:AMP.setState( { IzoMenuExpanded: ! IzoMenuExpanded } )" ';
			$input .= ' role="button" ';
			$input .= ' tabindex="0" ';

			$input .= ' aria-expanded="false" ';
			$input .= ' [aria-expanded]="IzoMenuExpanded ? \'true\' : \'false\'" ';

			return $input;
		}	
		
		public function add_nav_sub_menu_buttons( $item_output, $item ) {

			if ( !izo_is_amp() ) {
				return $item_output;
			}

			if ( ! in_array( 'menu-item-has-children', $item->classes, true ) ) {
				return $item_output;
			}

			$expanded = false;

			// Generate a unique state ID.
			static $nav_menu_item_number = 0;
			$nav_menu_item_number ++;
			$expanded_state_id = 'IzoMenuItemExpanded' . $nav_menu_item_number;

			$item_output .= sprintf(
				'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
				esc_attr( $expanded_state_id ),
				wp_json_encode( $expanded )
			);

			$dropdown_button = '<span';
			$dropdown_class  = 'submenu-toggle';
			$toggled_class   = 'toggled';
			$dropdown_button .= sprintf(
				' class="%s" [class]="%s"',
				esc_attr( $dropdown_class . ( $expanded ? " $toggled_class" : '' ) ),
				esc_attr( sprintf( "%s + ( $expanded_state_id ? %s : '' )", wp_json_encode( $dropdown_class ), wp_json_encode( " $toggled_class" ) ) )
			);

			$dropdown_button .= sprintf(
				' aria-expanded="%s" [aria-expanded]="%s"',
				esc_attr( wp_json_encode( $expanded ) ),
				esc_attr( "$expanded_state_id ? 'true' : 'false'" )
			);

			$dropdown_button .= sprintf(
				' on="%s"',
				esc_attr( "tap:AMP.setState( { $expanded_state_id: ! $expanded_state_id } )" )
			);

			$dropdown_button .= ' role="button" tabindex=0>';

			$dropdown_button .= '+</span>';

			$item_output .= $dropdown_button;

			return $item_output;
		}		

	}

	/**
	 * Initialize class
	 */
	Izo_AMP::get_instance();

endif;