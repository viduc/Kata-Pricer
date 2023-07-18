<?php
declare(strict_types=1);

namespace Pricer;

class Pricer
{
    private float $total;
    private array $reduction = [
        1000 => 3,
        5000 => 5
    ];

    public function calcul(int $nb, float $prix, int $taxe): string
    {
        $this->total = $nb * $prix;
        $this->appliquerReduction();
        $this->total += $this->total * $taxe / 100;
        return number_format(
            num: $this->total,
            decimals: 2,
            decimal_separator: '.',
            thousands_separator: ''
            ) . " €";
    }

    private function appliquerReduction(): void
    {
        $reduction = 0;
        array_walk(
            array: $this->reduction,
            callback: function ($value, $key) use (&$reduction) {
                if ($this->total > $key) {
                    $reduction = $value;
                }
            },
            arg: $reduction
        );

        $this->total -= $this->total * $reduction / 100;
    }
}