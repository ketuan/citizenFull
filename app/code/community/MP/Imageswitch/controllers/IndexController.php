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
class MP_Imageswitch_IndexController extends Mage_Core_Controller_Front_Action
{
	 /**
     * Initialize requested product object
     *
     * @return Mage_Catalog_Model_Product
     */
    protected function _initProduct()
    {
        Mage::dispatchEvent('catalog_controller_product_init_before', array('controller_action'=>$this));
        $categoryId = (int) $this->getRequest()->getParam('category', false);
        $productId  = (int) $this->getRequest()->getParam('id');

        if (!$productId) {
            return false;
        }

        $product = Mage::getModel('catalog/product')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($productId);

        /*if (!Mage::helper('catalog/product')->canShow($product)) {
            return false;
        }*/
        if (!in_array(Mage::app()->getStore()->getWebsiteId(), $product->getWebsiteIds())) {
            return false;
        }

        $category = null;
        if ($categoryId) {
            $category = Mage::getModel('catalog/category')->load($categoryId);
            $product->setCategory($category);
            Mage::register('current_category', $category);
        }
        elseif ($categoryId = Mage::getSingleton('catalog/session')->getLastVisitedCategoryId()) {
            if ($product->canBeShowInCategory($categoryId)) {
                $category = Mage::getModel('catalog/category')->load($categoryId);
                $product->setCategory($category);
                Mage::register('current_category', $category);
            }
        }


        Mage::register('current_product', $product);
        Mage::register('product', $product);

        try {
            Mage::dispatchEvent('catalog_controller_product_init', array('product'=>$product));
            Mage::dispatchEvent('catalog_controller_product_init_after', array('product'=>$product, 'controller_action' => $this));
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return false;
        }

        return $product;
    }
        
    public function indexAction()
    {
        //$prod_id  = (int) $this->getRequest()->getParam('prod_id');
        $prod_id=(int) $this->getRequest()->getParam('color_id');
        $product=Mage::getModel('catalog/product')->load($prod_id);
        /*if($color_value) {
            //$allProducts = $product->getTypeInstance(true)->getUsedProducts(null, $product);      
			$conf = Mage::getModel('catalog/product_type_configurable')->setProduct($product);
			$allProducts = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();				
            foreach ($allProducts as $prod) {
                if ($prod->getColor2()==$color_value) { // && $prod->isSaleable() 
                    break;
                }
            }           
            $prod_full=Mage::getModel('catalog/product')->load($prod->getId());
            Mage::register('product', $prod_full);
        }
        else {*/
            Mage::register('product', $product);
        //}
		//print($color_value);
        $this->loadLayout();     
        $this->renderLayout();
    }
	/*
	* Switch Product Image for Grouped Products
	*/
    public function productAction()
    {
        $prod_id  = (int) $this->getRequest()->getParam('prod_id');
        $product=Mage::getModel('catalog/product')->load($prod_id);
            Mage::register('product', $product);
        $this->loadLayout();     
        $this->renderLayout();
    }	
	  /**
     * View product gallery action
     */
    public function infoAction()
    {
        $prod_id=(int) $this->getRequest()->getParam('prod_id');
        $product=Mage::getModel('catalog/product')->load($prod_id);
        Mage::register('product', $product);
        $this->loadLayout();     
        $this->renderLayout();
    }
}