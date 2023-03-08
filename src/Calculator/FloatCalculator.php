<?php

declare(strict_types=1);

namespace Calculator;

use RuntimeException;

class FloatCalculator
{
    /**
     * Méthode d'addition de deux nombres flottants
     * @param float $firstOperand Premier opérande
     * @param float $secondOperand Second opérande
     * @return float Somme des deux opérandes
     */
    public function add(float $firstOperand, float $secondOperand): float
    {
        return $firstOperand+$secondOperand;
    }
    public function subtract(float $firstOperand, float $secondOperand): float
    {
        return $firstOperand-$secondOperand;
    }
    public function multiply(float $firstOperand, float $secondOperand): float
    {
        return $firstOperand*$secondOperand;
    }
    public function divide(float $firstOperand, float $secondOperand): float
    {
        if ($secondOperand == 0) {
            throw new RuntimeException();
        }
        return $firstOperand/$secondOperand;
    }
    public function modulus(float $firstOperand, float $secondOperand): float
    {
        if ($secondOperand == 0) {
            throw new RuntimeException();
        }
        return $firstOperand%$secondOperand;
    }
    public function sum(...$floats): float
    {
        $result = 0;
        foreach ($floats as $float) {
            $result += $float;
        }
        return $result;
    }
}
