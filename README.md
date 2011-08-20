# Magento Config API

Take a look at the (Magento Webservices Introduction)[http://www.magentocommerce.com/wiki/doc/webservices-api/introduction] page on the Magento Wiki if you're not sure how to connect and use the Magento API.

## Usage

The config API provides three methods, here are is some PHP to get you going:

**Read**
 $client->call($session, 'config.read', array('CONFIG_KEY'));

**Set**
 $client->call($session, 'config.set', array('CONFIG_KEY', 'NEW_VALUE'));

**Delete**
 $client->call($session, 'config.delete', array('CONFIG_KEY'));
