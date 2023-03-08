<?php

declare(strict_types=1);

namespace Calculator;

use PHPUnit\Framework\TestCase;

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
     * @dataProvider  additionProvider
     * @return void
     */
    public function testAdd(float $firstOperand, float $secondOperand, float $expected): void
    {
        assertSame($expected, $this->floatCalculator->add($firstOperand, $secondOperand));
    }
    public function testSubstract(): void
    {
        assertSame(1.0, $this->floatCalculator->subtract(2, 1));
        assertSame(-10.0, $this->floatCalculator->subtract(-5,5));
    }
}
