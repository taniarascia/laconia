<?php
/*
 *
 * (c) Kevin schmitt <kevin.schmitt.upjv@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Tests\Controller;

use Laconia\Controller;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for abstract controller
 *
 */
class ControllerTest extends TestCase
{

    /**
     * abstract controller mock
     *
     * @var Laconia\Controller
     */
    private $abstractController;

    public function setup() : void
    {
        $this->abstractController = $this->getMockAbstractController();
    }

    private function getMockAbstractController()
    {
        return  $this->getMockBuilder(\Laconia\Controller::class)
                     ->disableOriginalConstructor()
                     ->getMockForAbstractClass();
    }

    /**
     * Test special caracters are encoded
     * @dataProvider getSpecialCaracters
     */
    public function testEscape(string $caracter, string $encode)
    {           
        $this->assertEquals($encode, $this->abstractController->escape($caracter));     
    }

    public function getSpecialCaracters()
    {
        yield ['"', '&quot;'];
        yield ['&', '&amp;'];
        yield ['\'', '&#039;'];
    }

   
}