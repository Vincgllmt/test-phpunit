<?php

declare(strict_types=1);

namespace Calculator;

use PHPUnit\Framework\TestCase;
use RuntimeException;

use function PHPUnit\Framework\assertSame;

class FloatCalculatorTest extends TestCase
{
    protected FloatCalculator $floatCalculator;
    protected function setUp(): void
    {
        $this->floatCalculator = new FloatCalculator();
    }
    public function additionProvider(): array
    {
        return [
            [0, 0, 0.0],
            [0.5, 1.5, 2.0],
            [-1.0, 2.0, 1.0],
            [-1.0, -1.0, -2.0],
            [-1.8, -0.2, -2]
        ];
    }
    public function sumProvider(): array
    {
        return [
            [6.0, ...[1,2,3]],
            [0.0, ...[0]],
            [-2.0, ...[-1,-1]],
            [100.0, ...[10,20,30,40]]
        ];
    }
    public function modulusProvider(): array
    {
        return [
            '1. % 1 = 0' => [1,1,0],
            '10. % 3 = 1' => [10,3,1],
        ];
    }
    /**
     * @return void
     */
    public function testOnePlusTwoEqualThree(): void
    {
        $result = $this->floatCalculator->add(1, 2);
        assertSame(3.0, $result);
    }

    /**
     * @param float $firstOperand
     * @param float $secondOperand
     * @param float $expected
     * @return void
     * @dataProvider  additionProvider
     */
    public function testAdd(float $firstOperand, float $secondOperand, float $expected): void
    {
        assertSame($expected, $this->floatCalculator->add($firstOperand, $secondOperand));
    }
    public function testSubstract(): void
    {
        assertSame(1.0, $this->floatCalculator->subtract(2, 1));
        assertSame(-10.0, $this->floatCalculator->subtract(-5, 5));
    }
    public function testMultiply(): void
    {
        assertSame(10.0, $this->floatCalculator->multiply(2, 5));
        assertSame(0.0, $this->floatCalculator->multiply(1, 0));
    }
    public function testDivide(): void
    {
        assertSame(1.0, $this->floatCalculator->divide(1, 1));
        assertSame(5.0, $this->floatCalculator->divide(10, 2));
        $this->expectException(RuntimeException::class);
        $this->floatCalculator->divide(1, 0);
    }

    /**
     * @param float $firstOperand
     * @param float $secondOperand
     * @param float $expected
     * @return void
     * @dataProvider  modulusProvider
     */
    public function testModulus(float $firstOperand, float $secondOperand, float $expected): void
    {
        assertSame($expected, $this->floatCalculator->modulus($firstOperand, $secondOperand));
        $this->expectException(RuntimeException::class);
        $this->floatCalculator->divide(1, 0);
        assertSame(0.2, $this->floatCalculator->modulus(5, 2.4));
    }

    /**
     * @dataProvider sumProvider
     * @param float $expected
     * @param mixed ...$floats
     * @return void
     */
    public function testSum(float $expected, ...$floats): void
    {
        assertSame($expected, $this->floatCalculator->sum(...$floats));
    }
}
