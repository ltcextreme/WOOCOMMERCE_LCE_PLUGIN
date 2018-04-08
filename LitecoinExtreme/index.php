<?php
/**
 * Plugin Name: WooCommerce LitecoinExtreme [LCE] Plugin
 * Plugin URI: https://ltcextreme.com
 * Description: Adds LitecoinExtreme currency in WooCommerce
 * Author: LitecoinExtreme Team
 * Author URI: https://ltcextreme.com
 * Version: 3.0
 * License: GPLv2 or later
 */
if ( ! class_exists( 'WC_LCE_Currency' ) ) {
    /**
     * Add LCE Currency in WooCommerce.
     */
    class WC_LCE_Currency {
        /**
         * Class construct.
         */
        public function __construct() {
            // Actions.
            add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ), 0 );
            // Filters.
            add_filter( 'woocommerce_currencies', array( &$this, 'add_currency' ) );
            add_filter( 'woocommerce_currency_symbol', array( &$this, 'currency_symbol' ), 1, 2 );
        }
        /**
         * Load Plugin textdomain.
         *
         * @return void.
         */
        public function load_textdomain() {
            load_plugin_textdomain( 'wcLCE', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
        /**
         * Add LCE Currency in WooCommerce.
         *
         * @param  array $currencies Current currencies.
         *
         * @return array             Currencies with LCE.
         */
        public function add_currency( $currencies ) {
            $currencies['LCE'] = __( 'LitecoinExtreme', 'wcLCE' );
            asort( $currencies );
            return $currencies;
        }
        /**
         * Add LCE Symbol.
         *
         * @param  string $currency_symbol Currency symbol.
         * @param  array  $currency        Current currencies.
         *
         * @return string                  LCE currency symbol.
         */
        public function currency_symbol( $currency_symbol, $currency ) {
            switch( $currency ) {
                case 'LCE':
                    $currency_symbol = '&#321;';
                    break;
            }
            return $currency_symbol;
        }
    } // close WC_LCE_Currency class.
    $WC_LCE_Currency = new WC_LCE_Currency();
}