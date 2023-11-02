<?php

/**======Creating Option in Woocommerce Tab======**/
function wccpd_custom_address_option_on_wc_tab() {
    
    add_submenu_page('woocommerce','WC Distance Calculater', 'WC Distance Calculater', 'manage_options', 'address_and_date_time_picker', 'wccpd_cm_custom_address_settings');
}

function wccpd_cm_custom_address_settings(){
    
    if (wccpd_is_pro_installed()) {
        
        $ob = new WCCPD_Calculate_Miles_Pro;
        $ob->admin_notices_check(); //PRO NOTICES CHECK
        
        if(wccpd_is_license_valid()){
            if(WCCPD_PRO_VERSION != WCCPD_CURRENT_PRO_VERSION){
                echo '<div class="error notice">
				    <p>You are using the older version.Please Update The PRO Version of <span style="font-weight:bold;">'.WCCPD_ITEM_REFERENCE.'</span> !! <p>You need to login to client portal to download the latest version</p> <a href="https://woo-solutions.ca/clients/wp-login.php">Login Here</a></p>
				</div>';
            }
        }
        
    }
    $checkbox_vals = get_option('sm_saved_admin_settings');
    wccpd_load_templates('cm-admin-settings.php' , array('checkbox_vals' => $checkbox_vals));
}


function wccpd_getDistance($addressFrom, $addressTo, $unit = ''){
    // Google API key
    $cm_settings = get_option('sm_saved_admin_settings');

    $apiKey = isset($cm_settings['address_settings']['cm_address_apikey']) ? $cm_settings['address_settings']['cm_address_apikey'] : '';
    
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
    // Geocoding API request with start address
    $geocodeFrom = wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom['body']);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    // Geocoding API request with end address
    $geocodeTo = wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $data = isset($geocodeTo['body']) ? $geocodeTo['body'] : '';
    $outputTo = json_decode($data);
    
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    
    // Convert unit and return distance
    $unit = strtoupper($unit);
    if($unit == "K"){
        return round($miles * 1.609344, 2);
    }elseif($unit == "M"){
        return round($miles * 1609.344, 2).' meters';
    }else{
        return round($miles, 2);
    }
}


/****=====Get Longitude/latitude====***/
function wccpd_get_long_lat( $address ){
    
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $address);
    
    $cm_settings = get_option('sm_saved_admin_settings');

    $apiKey = isset($cm_settings['address_settings']['cm_address_apikey']) ? $cm_settings['address_settings']['cm_address_apikey'] : '';
    // Geocoding API request with start address
    $geocodeFrom = wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $data = isset($geocodeFrom['body']) ? $geocodeFrom['body'] : '';
    $outputFrom = json_decode($data);
    
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $resp = array(
        'latitude' => $latitudeFrom,
        'longitude' => $longitudeFrom,
    );
    return $resp;
}
/****=====Check IF is PRO Installed====***/
function wccpd_is_pro_installed(){
    $pluginList = get_option( 'active_plugins' );

        if (in_array('calculate-prices-based-on-distance-for-woocommerce-pro/calculate-prices-based-on-distance-for-woocommerce-pro.php', $pluginList)) {
            return true;
        }
        else return false;
}

//License Activation
function wccpd_is_license_valid(){
    
    $own_check = get_option('wccpd_pro_check_licenser');
    if ($own_check=='success') {
        return true;
    }
    else return false;
}
