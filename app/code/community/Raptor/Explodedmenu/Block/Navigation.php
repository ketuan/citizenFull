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
 * @category   Mage
 * @package    Mage_Catalog
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Catalog navigation
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Raptor_Explodedmenu_Block_Navigation extends Mage_Catalog_Block_Navigation
{
	public function drawItem($category, $level=0, $last=false,  $ind=0) {
		$html = ''; 
		if (!$category->getIsActive()) {
			return $html;
		}
		$activeChildren = $this->getActiveChildren($category);
		$html.= '<li class="top_level"';
		if (sizeof($activeChildren) > 0) {
			$html.= ' onmouseover="toggleMenu(this,1)" onmouseout="toggleMenu(this,0)"';		}
		if ($last) {
			$html .= ' last';
		}
		$html.= '>'."\n";
		$html.= '<a href="'.$this->getCategoryUrl($category).'"><span>'.$this->htmlEscape($category->getName()).'</span></a>'."\n";
 
		if (sizeof($activeChildren) > 0) {
			$html .=  $this->drawColumns($activeChildren,$ind);
		}
		$html .= "</li>";
		return $html;
	}

	/**
	 * Responsible for splitting the drop down box into columns and rendering the nested menus
	 *
	 * @param unknown_type $children
	 * @return unknown
	 */
	public function drawColumns($children,$ind ) {
		$categoriesPerColumn = $this->getConfigData('explodedmenu', 'columns', 'categories_per_column');

		$html = '';
		$chunks = array_chunk($children, $categoriesPerColumn);
		
		$html .= '<ul class="mnu_cola'.$ind.'">';
		$i = 0;
		foreach ($chunks as $key=>$value) {
			$html .= '<li class="columns">';
			$html .= $this->drawNestedMenus($value  );
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}

	public function drawNestedMenus($children ) {
		$html = '<ul>';
		
		foreach ($children as $child) {
			if ($child->getIsActive()) {
				$html .= '<li >';
				$html .= '<a href="'.$this->getCategoryUrl($child).'"><span>'.$this->htmlEscape($child->getName()).'</span></a>';
				$activeChildren = $this->getActiveChildren($child);
				if (sizeof($activeChildren) > 0) {
					$html .= $this->drawNestedMenus($activeChildren );
				}
				$html .= '</li>';
			}
		}
		$html .= '</ul>';
		return $html;
	}

	/**
	 * Gets all the active children of a category and puts them into an array. N.B. 
	 * we need an array because of the array_chunk() call in drawColumns();
	 *
	 * @param Category $parent
	 * @return unknown
	 */
/*	 
	public function getBrandsByCode($code,$category){
		$product = Mage::getModel('catalog/product');
//		$category = Mage::getModel('catalog/category')->load($_category->getId());		
		//$products = $category->getProductCollection();
		//$products -> addAttributeToSelect($code);
		//$products -> load();				
		$attributes = Mage::getResourceModel('eav/entity_attribute_collection')
		->setEntityTypeFilter($product->getResource()->getTypeId())
		->addFieldToFilter('attribute_code', $code)
		;
		
		$attribute = $attributes->getFirstItem()->setEntity($product->getResource());
		$manufacturers = $attribute->getSource()->getAllOptions(false);
		return  $manufacturers;
	}*/
	/* Get Brands for given $Category 
	** MP Added 20121207
	**/	
	public function getBrandsByCode($code,$category) {
		$store_id = Mage::app()->getStore()->getId();
		$products = Mage::getResourceModel('catalog/product_collection')
					->addStoreFilter($store_id)
					->addAttributeToSelect($code)
					->addCategoryFilter($category)
					->setOrder($code,'asc')					
		;
		foreach($products as $product){
			$manufacturers[$product->getManufacturer()] = $product->getAttributeText($code);//Manufacturer();
		}	
		return $manufacturers;
	}
	
	protected function getActiveChildren($parent) {
		$activeChildren = array();
		if (Mage::helper('catalog/category_flat')->isEnabled()) {
			$children = $parent->getChildrenNodes();
			$childrenCount = count($children);
		} else {
			$children = $parent->getChildren();
			$childrenCount = $children->count();
		} 
		$hasChildren = $children && $childrenCount;
		if ($hasChildren) {
			foreach ($children as $child) {
				if ($child->getIsActive()) {
					array_push($activeChildren, $child);
				}
			} 
		}
		return $activeChildren;
	}

    /**
     * Get url for category data
     *
     * @param Mage_Catalog_Model_Category $category
     * @return string
     */
    public function getCategoryPath($category)
    {        
		$url = '';
		if ($category instanceof Mage_Catalog_Model_Category) {
        $url = $category->getPathInStore();
	    $url = strtr($url, ".", "-");
	    $url = strtr($url, "/", "-");
        } else {
			// do nothing
        }
        return $url;
    }
	public function getSubCategories($parentId)
    {
        $helper = Mage::helper('catalog/category');
        return $helper->getSubCategories($parentId);
    } 
	public function getConfigData($namespace, $parentKey, $key) {
		$config = Mage::getStoreConfig($namespace);
		if (isset($config[$parentKey]) && isset($config[$parentKey][$key]) && strlen($config[$parentKey][$key]) > 0) {
			$value = $config[$parentKey][$key];
			return $value;
		} else {
			throw new Exception('Value not set');
		}
	}	

}
