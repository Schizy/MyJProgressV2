<?php

namespace App\Tests;

use App\Entity\Example;
use PHPUnit\Framework\TestCase;

final class GrammarTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
        self::assertEquals(42, 42);
        $this->assertEquals(42, 42);
    }

    /**
     * @dataProvider dataProvider
     * @dataProvider dataProvider2
     */
    public function testWithALongTitleInCamelCaseForTheDemoWithDox($truc, $bidule): void
    {
        self::assertContains('bidule', [$truc, $bidule]);
    }

    public function testWithAnEntityInstantiation(): void
    {
        $example = (new Example())->setPhrase('Phrase de test');

        self::assertSame('Phrase de test', $example->getPhrase());
    }

    public function dataProvider(): \Generator
    {
        yield 'Nom de la data' => ['truc', 'bidule'];
    }

    public function dataProvider2(): \Generator
    {
        yield 'Nom de la data 2' => ['truc', 'bidule'];
    }
}
