<?php
namespace TDD\Test;
require("vendor\autoload.php");

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

// Class that extends TestCase
class ReceiptTest extends TestCase {
    public function testTotal() {
        // Object
        $Receipt = new Receipt();
        // Test method
        $this->assertEquals(
            // Expected value
            15,
            //Total value
            $Receipt->total([0,2,5,8]),
            //Error message
            'When summing the total should equal 15'
        );
    }
}