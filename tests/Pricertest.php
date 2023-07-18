<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Pricer\Pricer;

class Pricertest extends TestCase
{
    private Pricer $pricer;

    public function setUp(): void
    {
        $this->pricer = new Pricer();
    }

    public static function pricerProvider(): array
    {
        return [
            [3, 1.21, 0, "3.63 €"],
            [3, 1.21, 5, "3.81 €"],
            [3, 1.21, 20, "4.36 €"],
            [5, 345, 10, "1840.58 €"],
            [5, 1299, 10, "6787.28 €"],
        ];
    }

    #[DataProvider('pricerProvider')]
    public function testPricer(int $nb, float $prix, int $taxe, string $expected): void
    {
        $this->assertEquals(
            expected: $expected,
            actual: $this->pricer->calcul(nb: $nb, prix: $prix, taxe: $taxe));
    }
}