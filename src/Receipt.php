<?php
namespace  TDD;
class Receipt {
    public function total(array $item = []) {
        return array_sum($item);
    }
}