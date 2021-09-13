<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 10.09.2021
 * Time: 18:03
 */
namespace MathTest;
use PHPUnit\Framework\TestCase;

class ComplexTest extends TestCase
{
    private $complex;

    /**
     * Setup tested class object
     */
    protected function setUp(): void
    {
        $this->complex = new \Math\ComplexNumber(5, 7);
    }

    /**
     *  Unset tested class object
     */
    protected function tearDown(): void
    {
        $this->complex = null;
    }

    public function testCreateReal()
    {
        $re = $this->complex->re;
        $this->assertEquals(5, $re);
    }

    public function testCreateIm()
    {
        $im = $this->complex->im;
        $this->assertEquals(7, $im);
    }

    /**
     * Test __toString method
     */

    public function testToString()
    {
        $text = (string) $this->complex;
        $this->assertEquals('5+j7', $text);
    }

    public function testToStringWithoutReal()
    {
        $a = new \Math\ComplexNumber(0, 5);
        $text = (string) $a;
        $this->assertEquals('j5', $text);
    }

    public function testToStringWithoutImagine()
    {
        $a = new \Math\ComplexNumber(5, 0);
        $text = (string) $a;
        $this->assertEquals('5', $text);
    }

    public function testToStringNegativeImagine()
    {
        $a = new \Math\ComplexNumber(5, -8);
        $text = (string) $a;
        $this->assertEquals('5-j8', $text);
    }

    public function testToStringZero()
    {
        $a = new \Math\ComplexNumber(0, 0);
        $text = (string) $a;
        $this->assertEquals('0', $text);
    }

    /**
     * Test isZero
     */
    public function testIsZero()
    {
        $a = new \Math\ComplexNumber(0,0);
        $this->assertEquals(true, $a->isZero());
    }

    public function testIsNotZeroRe()
    {
        $a = new \Math\ComplexNumber(1,0);
        $this->assertEquals(false, $a->isZero());
    }

    public function testIsNotZeroIm()
    {
        $a = new \Math\ComplexNumber(0,0.0002);
        $this->assertEquals(false, $a->isZero());
    }



    /**
     * Test add method
     */

    public function testAddEmpty()
    {
        $text = (string) $this->complex->add(null);
        $this->assertEquals('5+j7', $text);
    }

    public function testAddNumber()
    {
        $text = $this->complex->add(5);
        $this->assertEquals('10+j7', $text);
    }

    public function testAddArrayOfNumber()
    {
        $text = $this->complex->add([5,7,-8]);
        $this->assertEquals('9+j7', $text);
    }

    public function testAddComplex()
    {
        $a = new \Math\ComplexNumber(-4, -6);
        $text = $this->complex->add($a);
        $this->assertEquals('1+j1', $text);
    }

    public function testAddArrayOfComplex()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            new \Math\ComplexNumber(2, 5),
            new \Math\ComplexNumber(-3, 10),
            new \Math\ComplexNumber(8, 0)
        ];

        $text = $this->complex->add($arr);
        $this->assertEquals('8+j16', $text);
    }

    public function testAddArrayOfDiffTypes()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            5,
            null,
            new \Math\ComplexNumber(8, 0)
        ];

        $text = $this->complex->add($arr);
        $this->assertEquals('14+j1', $text);
    }

    /**
     * Test sub method
     */

    public function testSubEmpty()
    {
        $text = (string) $this->complex->sub(null);
        $this->assertEquals('5+j7', $text);
    }

    public function testSubNumber()
    {
        $text = $this->complex->sub(5);
        $this->assertEquals('j7', $text);
    }

    public function testSubArrayOfNumber()
    {
        $text = $this->complex->sub([5,7,-8]);
        $this->assertEquals('1+j7', $text);
    }

    public function testSubComplex()
    {
        $a = new \Math\ComplexNumber(-4, -6);
        $text = $this->complex->sub($a);
        $this->assertEquals('9+j13', $text);
    }

    public function testSubArrayOfComplex()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            new \Math\ComplexNumber(2, 5),
            new \Math\ComplexNumber(-3, 10),
            new \Math\ComplexNumber(8, 0)
        ];

        $text = $this->complex->sub($arr);
        $this->assertEquals('2-j2', $text);
    }

    public function testSubArrayOfDiffTypes()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            5,
            null,
            new \Math\ComplexNumber(8, 0)
        ];

        $text = $this->complex->sub($arr);
        $this->assertEquals('-4+j13', $text);
    }

    /**
     * Test mul method
     */

    public function testMulZero()
    {
        $text = $this->complex->mul(0);
        $this->assertEquals('0', $text);
    }

    public function testMulNumber()
    {
        $text = $this->complex->mul(5);
        $this->assertEquals('25+j35', $text);
    }

    public function testMulArrayOfNumber()
    {
        $text = $this->complex->mul([5,0.7,-0.8]);
        $this->assertEquals('-14-j19.6', $text);
    }

    public function testMulComplex()
    {
        $a = new \Math\ComplexNumber(-4, -6);
        $text = $this->complex->mul($a);
        $this->assertEquals('22-j58', $text);
    }

    public function testMulArrayOfComplex()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            new \Math\ComplexNumber(2, 5),
            new \Math\ComplexNumber(-3, 10),
            new \Math\ComplexNumber(8, 0)
        ];

        $text = $this->complex->mul($arr);
        $this->assertEquals('-7536+j26864', $text);
    }

    public function testMulArrayOfDiffTypes()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            5,
            new \Math\ComplexNumber(8, 0)
        ];

        $text = $this->complex->mul($arr);
        $this->assertEquals('880-j2320', $text);
    }

    public function testMulWithZero()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            5,
            new \Math\ComplexNumber(8, 0),
            0
        ];

        $text = $this->complex->mul($arr);
        $this->assertEquals('0', $text);
    }

    public function testMulWithZeroComplex()
    {
        $arr = [
            new \Math\ComplexNumber(-4, -6),
            5,
            new \Math\ComplexNumber(0, 0),
            8
        ];

        $text = $this->complex->mul($arr);
        $this->assertEquals('0', $text);
    }

    /**
     * Test div method
     */

}