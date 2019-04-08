<?php
namespace TDD\Test;
require("vendor\autoload.php");

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

// Class that extends TestCase
class ReceiptTest extends TestCase {
    public function setUp() {
       $this->Receipt = new Receipt();
    }

    public function setDown() {
        unset($this->Receipt);
    }
    public function testTotal() {
        // Input values
        $input = ([0,2,5,8]);
        $coupon = null;
        $output = $this->Receipt->total($input, $coupon);
        // Test method
        $this->assertEquals(
            // Expected value
            15,
            // Output variable
            $output,
            //Error message
            'When summing the total should equal 15'
        );
    }

    public function testTotalAndCoupon() {
        // Input values
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $this->Receipt->total($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'When summing the total should equal 12'
        );
    }

    public function testPostTaxTotal() {
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $Receipt->method('total')
            ->will($this->returnValue(10.00));
        $Receipt->method('tax')
            ->will($this->returnValue(1.00));
        $result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null);
        $this->assertEquals(11.00, $result);
    }

    public function testTax() {
        // Add values to input
        $inputAmount = 10.00;
        // Tax %
        $taxInput = 0.10;
        // Add value for output
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        // Test method
        $this->assertEquals(
            1.00,
            // Output variable
            $output,
            //Error message
            'The tax calculation should equal 1.00'
        );
    }
}