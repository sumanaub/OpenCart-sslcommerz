<?php
/**
 * EasyPayWay - Online Payment Gateway For Bangladesh | Support Local & International Visa Master American Express Nexus Q-Cash
 * PHP4 und PHP5
 *
 * @version 1.1
 * @author Jm Redwan <redwan@thecodero.com>
 * @copyright 2012 easypayway.com
 * Free Payment Module for OpenCart.com
 */
class ModelPaymentSSLCommerce extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('payment/SSLCommerce');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('SSLCommerce_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		if ($this->config->get('SSLCommerce_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('SSLCommerce_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true; 
		} else {
			$status = false;
		}	
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'SSLCommerce',
				'terms'      => '',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('SSLCommerce_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
?>