<?php
/**
 * Yumba Soft
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Yumba
 * @package    Yumba_OrderCancel
 * @copyright  Copyright (c) 2011 Yumba Soft (yumba.soft@gmail.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * OrderCancel controller class
 */
class MP_Product_IndexController extends Mage_Core_Controller_Front_Action
{	  
	public function indexAction()
	{
        $this->loadLayout();     
        $this->renderLayout();		
	}
	  /**
     * View product gallery action
     */
    public function updateAction()
    {
		$todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);	
		$collection = Mage::getResourceModel('catalog/product_collection');
		$collection2 = Mage::getResourceModel('catalog/product_collection');		
		$attr =  Mage::app()->getRequest()->getParam('attr');
		$attr_value = Mage::app()->getRequest()->getParam('attr_value');
		if($attr=='promotion'){
	        $collection	->addAttributeToFilter('special_price', array('neq' => ""))
						->addAttributeToFilter('special_from_date', array(
									array(
										'attribute' => 'special_from_date',
										'date' => true,
										'to' => $todayDate
									)
								)
						)
						->addAttributeToFilter('special_to_date', array(
    								array(
        								'attribute' => 'special_to_date',
        								'date' => true,
        								'from' => $todayDate
    								),
    								array(
        							'attribute' => 'special_to_date',
        							'null' => 1
    								)
							)
				);
			foreach ($collection as $_product){
				$_product->setPromotion($attr_value);
				$_product->save();
			}
     		$collection2	->addAttributeToFilter('special_price', array('neq' => ""))						
							->addAttributeToFilter('special_to_date', array(
    								array(
        								'attribute' => 'special_to_date',
        								'date' => true,
        								'to' => $yesterDate
    								)
							)
				);
			foreach ($collection as $_product){
				$_product->setPromotion($attr_value);
				$_product->save();
			}			
		}
    }
	public function imguploaderAction()
	{
        $prod_id=(int) $this->getRequest()->getParam('prodId');
        $product=Mage::getModel('catalog/product')->load($prod_id);
        Mage::register('product', $product);
        $this->loadLayout();     
        $this->renderLayout();
	}
}