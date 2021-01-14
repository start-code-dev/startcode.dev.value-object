<?php

use Startcode\ValueObject\ArrayList;
use Startcode\ValueObject\StringLiteral;

class ArrayListTest extends \PHPUnit\Framework\TestCase
{
    public function testHas(): void
    {
        $anArrayList = new ArrayList(['a path']);
        $this->assertFalse($anArrayList->has('b'));
        $this->assertTrue($anArrayList->has('a path'));

        $anArrayList = new ArrayList([]);
        $this->assertFalse($anArrayList->has('a'));
    }

    public function testGetAll(): void
    {
        $this->assertEquals(['value'], (new ArrayList(['value']))->getAll());
        $this->assertEquals([], (new ArrayList([]))->getAll());
    }

    public function testToString(): void
    {
        $anArrayList = new ArrayList(['tags1', 'tags2', 'tags3']);
        $this->assertEquals('tags1tags2tags3', $anArrayList->toString());
        $this->assertEquals('tags1|tags2|tags3', $anArrayList->toString(new StringLiteral('|')));
        $this->assertEquals('tags1-tags2-tags3', $anArrayList->toString(new StringLiteral('-')));

        $anArrayList = new ArrayList([]);
        $this->assertEmpty($anArrayList->toString());
        $this->assertEmpty($anArrayList->toString(new StringLiteral('|')));
        $this->assertEmpty($anArrayList->toString(new StringLiteral('-')));
    }

    public function testAdd(): void
    {
        $anArrayList = new ArrayList([
            'value1',
            'value2',
            'value3',
        ]);
        $this->assertEquals([
            'value1',
            'value2',
            'value3',
        ], $anArrayList->getAll());

        $anArrayList->add('value4');
        $this->assertEquals([
            'value1',
            'value2',
            'value3',
            'value4',
        ], $anArrayList->getAll());
    }

    public function testCount(): void
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];

        $anArrayList = new ArrayList($data);
        $this->assertEquals(3, $anArrayList->count());
    }

    public function testEquals(): void
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];

        $anArrayList = new ArrayList($data);

        $this->assertTrue($anArrayList->equals(new ArrayList($data)));
        $this->assertTrue($anArrayList->equals(new ArrayList([
            'value1',
            'value2',
            'value3',
        ])));
        $this->assertFalse($anArrayList->equals(new ArrayList([
            'value1',
            'value3',
        ])));
    }

    public function testRemove(): void
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];

        $anArrayList = new ArrayList($data);

        $newArrayList = $anArrayList->remove('value2');

        $this->assertEquals($data, $anArrayList->getAll());
        $this->assertEquals(['value1', 'value3'], $newArrayList->getAll());
    }

    public function testMergeKey() : void
    {
        $aList = new ArrayList([
            [
               'name' => 'john',
               'age'  => 25
            ],
            [
                'name' => 'mike',
                'age'  => 33
            ],
            [
                'name' => 'sally',
                'age'  => 28
            ]
        ]);
        $anotherList = new ArrayList([
            [
                'name'   => 'sally',
                'height' => 170
            ],
            [
                'name'   => 'john',
                'height' => 180
            ],
            [
                'name'   => 'mike',
                'height' => 190
            ]
        ]);

        $this->assertEquals(
            [
                [
                    'name'   => 'john',
                    'age'    => 25,
                    'height' => 180
                ],
                [
                    'name' => 'mike',
                    'age' => 33,
                    'height' => 190
                ],
                [
                    'name' => 'sally',
                    'age' => 28,
                    'height' => 170
                ]
            ],
            $aList->mergeKey('name', $anotherList)->getAll()
        );
    }
}
