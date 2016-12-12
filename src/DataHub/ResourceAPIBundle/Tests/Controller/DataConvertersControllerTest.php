<?php

namespace DataHub\ResourceAPIBundle\Tests\Controller;

use DataHub\OAuthBundle\Tests\OAuthTestCase;

class DataConvertersControllerTest extends OAuthTestCase
{
    public function testDataConvertersCrudAction()
    {
        list($crawler, $response, $data) = $this->apiRequest('GET', '/v1/data/converters');
        $this->assertTrue($response->isSuccessful());
        $this->assertCRUDListContent($data);
    }
}