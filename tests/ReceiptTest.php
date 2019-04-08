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
        // Input
        $input = ([0,2,5,8]);
        $output = $this->Receipt->total($input);
        // Test method
        $this->assertEquals(
            // Expected value
            15,
            $output,
            //Error message
            'When summing the total should equal 15'
        );
    }

    public function testTax() {
        // Add values to input
        $inputAmount = 10.00;
        $taxInput = 0.10;
        // Add value for output
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        // Test method
        $this->assertEquals(
            1.00,
            $output,
            //Error message
            'Tax should equal 1.00'
        );
    }
}