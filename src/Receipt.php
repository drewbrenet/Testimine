<?php
namespace  TDD;
class Receipt {
    public function total(array $item = []) {
        return array_sum($item);
    }
    public function tax($ammount, $tax){
       return ($ammount * $tax);
    }
}