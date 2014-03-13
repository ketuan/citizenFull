<?php
class Mage_Catalog_Block_Product_New extends Mage_Catalog_Block_Product_Abstract
{
    protected $_defaultToolbarBlock = 'catalog/product_list_toolbar';
    
    protected $_productsCount = null;
    
    protected $_defaultColumnCount = 3;

    const DEFAULT_PRODUCTS_COUNT = 9;

    protected function _beforeToHtml()
    {
        $toolbar = $this->getToolbarBlock();
        
        $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        
        $collection = Mage::getResourceModel('catalog/product_collection');
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        
        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate))
            ->addAttributeToFilter('news_to_date', array('or'=> array(
                0 => array('date' => true, 'from' => $todayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->addAttributeToSort('news_from_date', 'desc')
        ;
        
        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }

        $this->setProductCollection($collection);
        
        $toolbar->setCollection($collection);

        $this->setChild('toolbar', $toolbar);
        Mage::dispatchEvent('catalog_block_product_list_collection', array(
            'collection'=>$collection,
        ));
        
        $collection->load();
        Mage::getModel('review/review')->appendSummary($collection);
        
        return parent::_beforeToHtml();
    }
    
    public function getToolbarBlock()
    {
        if ($blockName = $this->getToolbarBlockName()) {
            if ($block = $this->getLayout()->getBlock($blockName)) {
                return $block;
            }
        }
        $block = $this->getLayout()->createBlock($this->_defaultToolbarBlock, microtime());
        return $block;
    }
    
    public function setCollection($collection)
    {
        $this->_productCollection = $collection;
        return $this;
    } 
}
?>