<?php 
/*
******
*  Moudule cho phep tu dong hien thi San pham Lien quan trong chi tiet sp
*  MP: 2012-10-11
*/
?>
<?php
class MP_Autoupsell_Block_Upsell extends Mage_Catalog_Block_Product_List_Upsell 
{
    
	protected function _prepareData()
    {
        $product = Mage::registry('product');
        $product_id = $product->getId();

		// get current product category
        if (Mage::registry('current_category')) 
		{
            $category = Mage::registry('current_category');
        } else 
		{
            $catids = $product->getCategoryIds();
            $cat_id = (int) array_pop($catids);
            if ($cat_id <= 0) return $this;
            $category = Mage::getModel("catalog/category")->load($cat_id);
        }
        if (! $category instanceof Mage_Catalog_Model_Category) return $this;
		
		// Get Product Attributes
        $attributes = Mage::getSingleton('catalog/config')
            ->getProductAttributes();

        $this->_itemCollection =   Mage::getResourceModel('catalog/product_collection')
			->addAttributeToSelect($attributes)
	        ->addCategoryFilter($category)
	        ->addStoreFilter()
	        ->setPageSize(39) // display 8 related products
	        ->setCurPage(1)
	        ->addIdFilter(array($product_id), true);
	    $this->_itemCollection->getSelect()->orderRand();
        if (Mage::helper('catalog')->isModuleEnabled('Mage_Checkout')) 
		{
			Mage::getResourceSingleton('checkout/cart')
				->addExcludeProductFilter($this->_itemCollection, Mage::getSingleton('checkout/session')->getQuoteId());
            $this->_addProductAttributesAndPrices($this->_itemCollection);
        }
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($this->_itemCollection);
        $this->_itemCollection->load();
        foreach ($this->_itemCollection as $product) {
            $product->setDoNotUseCategoryId(true);
        }
        return $this;
    }
}