<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\ServiceBus\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */

namespace Tests\Unit\WindowsAzure\ServiceBus\Models;
use WindowsAzure\ServiceBus\Models\CorrelationFilter;

/**
 * Unit tests for class CorrelationFilter
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\ServiceBus\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: 0.4.2_2016-04
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */
class CorrelationFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers WindowsAzure\ServiceBus\Models\CorrelationFilter::__construct
     */
    public function testCorrelationFilterConstructor()
    {
        // Setup
        
        // Test
        $getRuleResult = new CorrelationFilter();
        
        // Assert
        $this->assertNotNull($getRuleResult);
    }

    /** 
     * @covers WindowsAzure\ServiceBus\Models\CorrelationFilter::getCorrelationId
     * @covers WindowsAzure\ServiceBus\Models\CorrelationFilter::setCorrelationId
     */
    public function testGetSetCorrelationId() {
        // Setup
        $expected = 'testCorrelationId';
        $className = new CorrelationFilter();

        // Test
        $className->setCorrelationId($expected);
        $actual = $className->getCorrelationId();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );

    }


}


