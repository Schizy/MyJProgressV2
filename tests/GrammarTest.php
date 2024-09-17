<?php

namespace App\Tests;

use App\Entity\Example;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GrammarTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
        self::assertEquals(42, 42);
        $this->assertEquals(42, 42);
    }

    #[DataProvider('dataProvider')]
    #[DataProvider('dataProvider2')]
    public function testWithALongTitleInCamelCaseForTheDemoWithDox($truc, $bidule): void
    {
        self::assertContains('bidule', [$truc, $bidule]);
    }

    public function testWithAnEntityInstantiation(): void
    {
        $example = (new Example())->setPhrase('Phrase de test');

        self::assertSame('Phrase de test', $example->getPhrase());
    }

    public function testTruc1(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc2(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc3(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc4(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc5(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc6(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc7(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc8(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc9(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc10(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc11(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc12(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc13(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc14(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc15(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc16(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc17(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public function testTruc18(): void
    {
        $this->assertTrue(0.5 > random_int(0, 1));
    }

    public static function dataProvider(): \Generator
    {
        yield 'Nom de la data' => ['truc', 'bidule'];
        yield 'Nom de la data3' => ['truc', 'chouette'];
    }

    public static function dataProvider2(): \Generator
    {
        yield 'Nom de la data 2' => ['truc', 'bidule'];
    }
}
