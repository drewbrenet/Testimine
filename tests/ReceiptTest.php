<?php
namespace TDD\Test;
require("vendor\autoload.php");

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

// Class that extends TestCase
class ReceiptTest extends TestCase {
    // Method that initialize object
    public function setUp() {
        // Create variable
       $this->Receipt = new Receipt();
    }

    public function tearDown() {
        //Removes variable
        unset($this->Receipt);
    }

    /**
     * @dataProvider provideTotal
     */
    public function testTotal($items, $expected) {
        $coupon = null;
        $output = $this->Receipt->total($items, $coupon);
        // Test method
        $this->assertEquals(
            // Expected value
            $expected,
            // Output variable
            $output,
            //Error message
            "When summing the total should equal {$expected}"
        );
    }

    public function provideTotal() {
        //Return array of total values
        return [
            'ints totaling 16' => [[1,2,5,8], 16],
            [[-1,2,5,8], 14],
            [[1,2,8], 11],
        ];
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
        // items value
        $items = [1,2,5,8];
        // tax value
        $tax = 0.20;
        // coupon is equal to null
        $coupon = null;
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        // Will expect total method only once
        $Receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));
        // Will expect tax method only once
        $Receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));
        // Result is equal to ...
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