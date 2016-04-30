<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_ReviewRecent
 * @copyright   Copyright (c) 2015 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Faonni_ReviewRecent_Block_List
	extends Mage_Core_Block_Template
{
    /**
     * Review collection
     *
     * @var Mage_Review_Model_Resource_Review_Product_Collection
     */
	protected $_reviewsCollection;
	
    /**
     * Retrieve recent review collection
     *
     * @return Mage_Review_Model_Resource_Review_Product_Collection
     */	
	function getReviewsCollection() 
	{
		if (null === $this->_reviewsCollection) {
			$store = Mage::app()->getStore();
			
			$this->_reviewsCollection = Mage::getResourceModel('review/review_product_collection');
			$this->_reviewsCollection->getSelect()->limit(Mage::getStoreConfig('catalog/review/sidebar_review_count'));
			
			$this->_reviewsCollection
				->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)
				->setStoreFilter($store->getId()) 
				->addAttributeToSelect('thumbnail')
				->addAttributeToSelect(array('name', 'visibility'), 'inner');
				
			Mage::getSingleton('catalog/product_status')->addSaleableFilterToCollection($this->_reviewsCollection);
			Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($this->_reviewsCollection);
			
			$this->_reviewsCollection
				->setDateOrder()
				->addRateVotes()
				->addUrlRewrite();
		}				
		return $this->_reviewsCollection;
	}
	
    /**
     * Prevent displaying if the block is not available
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!Mage::helper('faonni_reviewrecent')->isEnabled()) {
			return '';
		}
		
		$area = Mage::getStoreConfig('catalog/review/sidebar_area');

		if ((false === strpos($this->getNameInLayout(), Faonni_ReviewRecent_Model_Sidebar::LEFT) && $area == Faonni_ReviewRecent_Model_Sidebar::LEFT) || 
			(false === strpos($this->getNameInLayout(), Faonni_ReviewRecent_Model_Sidebar::RIGHT) && $area == Faonni_ReviewRecent_Model_Sidebar::RIGHT)) {
			return '';
		}
	
        return parent::_toHtml();
    }	
}