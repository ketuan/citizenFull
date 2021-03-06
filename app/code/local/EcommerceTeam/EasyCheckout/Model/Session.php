<?php
/**
 * Easy Checkout - Magento Extension
 *
 * @package:    EasyCheckout
 * @category:   EcommerceTeam
 * @copyright:  Copyright 2013 EcommerceTeam Inc. (http://www.ecommerce-team.com)
 * @version:    2.0.1
 */

class EcommerceTeam_EasyCheckout_Model_Session
    extends Mage_Checkout_Model_Session
{
    /**
     * Clear old data
     */
    public function clear()
    {
        parent::clear();
        $this->unsetData('customer_loaded');
    }
}
