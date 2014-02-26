<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_AdminNotification
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * AdminNotification observer
 *
 * @category   Mage
 * @package    Mage_AdminNotification
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Sm_Sport_Model_Observer
{
    /**
     * Predispath admin action controller
     *
     * @param Varien_Event_Observer $observer
     */
	public function saveProductVisitHistory(Varien_Event_Observer $observer) {

	    if(Mage::getSingleton('customer/session')->isLoggedIn()) {
	        $customer = Mage::getSingleton('customer/session')->getCustomer();

	        $product = Mage::registry('current_product');
	        if(!$product->offsetExists('customer_ids_visit_product')){ return; }
			$customer_ids_visit_product = ($product->getCustomerIdsVisitProduct())?explode(',', $product->getCustomerIdsVisitProduct()):array();
			if(!in_array($customer->getId(), $customer_ids_visit_product)){
				$customer_ids_visit_product[] = $customer->getId();
				$tostr = implode(",", $customer_ids_visit_product);
				//echo $tostr;die;
				$product->setData('customer_ids_visit_product',$tostr);
				$product->save();
			}
			return;

	    }
	    return;
	}
}
