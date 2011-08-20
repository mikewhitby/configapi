<?php
/**
 * @category    Mikewhitby
 * @package     Mikewhitby_Configapi
 * @copyright   Copyright (c) 2011 Mikewhitby (http://www.mikewhitby.info)
 * @license     http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

/**
 * Configuration API Model
 *
 * @category    Mikewhitby
 * @package     Mikewhitby_Configapi
 * @copyright   Copyright (c) 2011 Mikewhitby (http://www.mikewhitby.info)
 * @license     http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @author      Mike Whitby <me@mikewhitby.info>
 */
class Mikewhitby_Configapi_Model_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * Set current store for catalog.
     *
     * @param string|int $store
     * @return int
     */
    public function currentStore($store=null)
    {
        if (!is_null($store)) {
            try {
                $storeId = Mage::app()->getStore($store)->getId();
            } catch (Mage_Core_Model_Store_Exception $e) {
                $this->_fault('store_not_exists');
            }

            $this->_getSession()->setData($this->_storeIdSessionField, $storeId);
        }

        return $this->_getStoreId();
    }

    /**
     * Read a config value
     *
     * @param string $key The key to read
     * @return mixed the config value
     */
    public function read($key)
    {
        if (!Mage::getStoreConfig($key)) {
            $this->_fault('key_not_exists');
        }
        return Mage::getStoreConfig($key);
    }

    /**
     * Set a config value
     *
     * @param string $key   The key to set
     * @param string $value The value to set the key to
     * @return boolean True on success
     */
    public function set($key, $value)
    {
        if (!is_scalar($value)) {
            $this->_fault('data_invalid', 'value must be a scalar');
        }
        Mage::getModel('core/config')->saveConfig($key, $value);
        return true;
    }

    /**
     * Delete a config key
     *
     * @param string $key The key to delete
     * @return boolean True on success
     */
    public function delete($key)
    {
        if (!Mage::getStoreConfig($key)) {
            $this->_fault('key_not_exists');
        }
        Mage::getModel('core/config')->deleteConfig($key);
        return true;
    }
}
