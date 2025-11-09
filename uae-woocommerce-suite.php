<?php
/**
 * Plugin Name: UAE WooCommerce Suite
 * Plugin URI: https://github.com/afsaralmahmud/uae-woocommerce-suite
 * Description: Adds UAE emirates (subdivisions) to WooCommerce and hides flat rate when free shipping is available.
 * Version: 1.1
 * Author: Afsar Al Mahmud
 * Author URI: https://skyseekers.ae/
 * License: GPLv2 or later
 * Text Domain: uae-woocommerce-suite
 */

// =============================================
// UAE Subdivisions for WooCommerce
// =============================================
add_filter('woocommerce_states', 'custom_uae_woocommerce_states');
function custom_uae_woocommerce_states($states) {
    $states['AE'] = array(
        'DU' => 'Dubai',
        'AZ' => 'Abu Dhabi',
        'SH' => 'Sharjah',
        'AJ' => 'Ajman',
        'FU' => 'Fujairah',
        'RA' => 'Ras Al Khaimah',
        'UM' => 'Umm Al Quwain',
    );
    return $states;
}

// =============================================
// Hide Flat Rate When Free Shipping Is Available
// =============================================
add_filter('woocommerce_package_rates', 'hide_flat_rate_when_free_shipping_available', 10, 2);
function hide_flat_rate_when_free_shipping_available($rates, $package) {
    $free_shipping = array();

    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            $free_shipping[$rate_id] = $rate;
        }
    }

    return !empty($free_shipping) ? $free_shipping : $rates;
}
