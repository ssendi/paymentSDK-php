<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

namespace WirecardTest\PaymentSdk\Response;


use Wirecard\PaymentSdk\Entity\CustomField;
use Wirecard\PaymentSdk\Entity\CustomFieldCollection;
use Wirecard\PaymentSdk\Response\Response;

class ResponseUTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Response
     */
    private $response;

    public function setUp()
    {
        $simpleXml = simplexml_load_string('<raw>
                        <request-id>123</request-id>
                        <statuses>
                            <status code="1" description="a" severity="0"/>
                        </statuses>
                        <custom-fields>
                            <custom-field field-name="paysdk_testfield1" field-value="value1"/>
                            <custom-field field-name="paysdk_testfield2" field-value="value2"/>
                        </custom-fields>
                    </raw>');
        $this->response = $this->getMockForAbstractClass(Response::class, [$simpleXml]);
    }

    public function testGetCustomFieldCollection()
    {
        $customFieldCollection = new CustomFieldCollection();
        $customFieldCollection->add(new CustomField('testfield1', 'value1'));
        $customFieldCollection->add(new CustomField('testfield2', 'value2'));
        $this->assertEquals($customFieldCollection, $this->response->getCustomFields());
    }
}