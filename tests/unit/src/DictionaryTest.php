<?php

use Startcode\ValueObject\Dictionary;
use Startcode\ValueObject\StringLiteral;

class DictionaryTest extends \PHPUnit\Framework\TestCase
{

    public function testHas(): void
    {
        $aDictionary = new Dictionary(['a' => 'a path']);
        $this->assertFalse($aDictionary->has('b'));
        $this->assertTrue($aDictionary->has('a'));

        $aDictionary = new Dictionary([]);
        $this->assertFalse($aDictionary->has('a'));
    }

    public function testHasNonEmptyValue(): void
    {
        $aDictionary = new Dictionary(['a' => 'a path']);
        $this->assertTrue($aDictionary->hasNonEmptyValue('a'));
        $this->assertFalse($aDictionary->hasNonEmptyValue('b'));

        $aDictionary = new Dictionary(['a' => ['b' => 'c']]);
        $this->assertTrue($aDictionary->hasNonEmptyValue('a'));

        $aDictionary = new Dictionary(['a' => '']);
        $this->assertFalse($aDictionary->hasNonEmptyValue('a'));

        $aDictionary = new Dictionary(['a' => 0]);
        $this->assertFalse($aDictionary->hasNonEmptyValue('a'));

        $aDictionary = new Dictionary(['a' => []]);
        $this->assertFalse($aDictionary->hasNonEmptyValue('a'));

        $aDictionary = new Dictionary([]);
        $this->assertFalse($aDictionary->hasNonEmptyValue('a'));
        $this->assertFalse($aDictionary->hasNonEmptyValue(''));
    }

    public function testHasInDeeperLevels(): void
    {
        $data = [
            'a' => [
                'b' => [
                    'c' => 'path'
                ]
            ]
        ];
        $aDictionary = new Dictionary($data);

        $this->assertTrue($aDictionary->hasInDeeperLevels('a'));
        $this->assertTrue($aDictionary->hasInDeeperLevels('a', 'b'));
        $this->assertTrue($aDictionary->hasInDeeperLevels('a', 'b', 'c'));

        $this->assertFalse($aDictionary->hasInDeeperLevels('f', 'b', 'c'));
        $this->assertFalse($aDictionary->hasInDeeperLevels('a', 'f', 'c'));
        $this->assertFalse($aDictionary->hasInDeeperLevels('a', 'b', 'f'));
        $this->assertFalse($aDictionary->hasInDeeperLevels('a', 'b', 'c', 'f'));

        $aDictionary = new Dictionary([]);
        $this->assertFalse($aDictionary->hasInDeeperLevels('a'));
        $this->assertFalse($aDictionary->hasInDeeperLevels('f', 'b'));
    }

    public function testGet(): void
    {
        $aDictionary = new Dictionary(['a' => 'a path']);
        $this->assertEquals('a path', $aDictionary->get('a'));
        $this->assertNull($aDictionary->get('b'));

        $aDictionary = new Dictionary([]);
        $this->assertNull($aDictionary->get('a'));
    }

    public function testGetFromDeeperLevels(): void
    {
        $data = [
            'a' => [
                'b' => [
                    'c' => 'path'
                ]
            ]
        ];
        $aDictionary = new Dictionary($data);

        $this->assertEquals($data['a'], $aDictionary->getFromDeeperLevels('a'));
        $this->assertEquals($data['a']['b'], $aDictionary->getFromDeeperLevels('a', 'b'));
        $this->assertEquals($data['a']['b']['c'], $aDictionary->getFromDeeperLevels('a', 'b', 'c'));

        $this->assertNull($aDictionary->getFromDeeperLevels('f', 'b'));
        $this->assertNull($aDictionary->getFromDeeperLevels('a', 'f', 'c'));
        $this->assertNull($aDictionary->getFromDeeperLevels('a', 'b', 'f'));
        $this->assertNull($aDictionary->getFromDeeperLevels('a', 'b', 'c', 'f'));

        $aDictionary = new Dictionary([]);
        $this->assertNull($aDictionary->getFromDeeperLevels('a'));
        $this->assertNull($aDictionary->getFromDeeperLevels('f', 'b'));
    }

    public function testGetAll(): void
    {
        $this->assertEquals(['key' => 'value'], (new Dictionary(['key' => 'value']))->getAll());
        $this->assertEquals([], (new Dictionary([]))->getAll());
    }

    public function testHasKeys(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];
        $aDictionary = new Dictionary($data);
        $this->assertTrue($aDictionary->hasKeys(['key1', 'key2', 'key3']));
        $this->assertFalse($aDictionary->hasKeys(['key432', 'key342', 'key5487']));

        $aDictionary = new Dictionary([]);
        $this->assertFalse($aDictionary->hasKeys(['key1', 'key2']));
    }

    public function testToString(): void
    {
        $aDictionary = new Dictionary(['tags1', 'tags2', 'tags3']);
        $this->assertEquals('tags1tags2tags3', $aDictionary->toString());
        $this->assertEquals('tags1|tags2|tags3', $aDictionary->toString(new StringLiteral('|')));
        $this->assertEquals('tags1-tags2-tags3', $aDictionary->toString(new StringLiteral('-')));

        $aDictionary = new Dictionary([]);
        $this->assertEmpty($aDictionary->toString());
        $this->assertEmpty($aDictionary->toString(new StringLiteral('|')));
        $this->assertEmpty($aDictionary->toString(new StringLiteral('-')));
    }

    public function testAdd(): void
    {
        $aDictionary = new Dictionary([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ]);
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ], $aDictionary->getAll());

        $aDictionary->add('key4', 'value4');
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        ], $aDictionary->getAll());
    }

    public function testSlice(): void
    {
        $aDictionary = new Dictionary(
            [
                'group1' => [
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3',
                ],
                'group2' => [
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3',
                ],
            ]
        );

        $slicedDictionary = $aDictionary->slice('group2');

        $this->assertInstanceOf(Dictionary::class, $slicedDictionary);
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ], $slicedDictionary->getAll());
    }

    public function testCount(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $dictionary = new Dictionary($data);
        $this->assertEquals(3, $dictionary->count());
    }

    public function testCurrent(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $dictionary = new Dictionary($data);
        $this->assertEquals('value1', $dictionary->current());
    }

    public function testCurrentEmpty(): void
    {
        $data = [];

        $dictionary = new Dictionary($data);
        $this->assertEquals(null, $dictionary->current());
    }

    public function testKey(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $dictionary = new Dictionary($data);
        $this->assertEquals('key1', $dictionary->key());
    }

    public function testKeyEmpty(): void
    {
        $data = [];

        $dictionary = new Dictionary($data);
        $this->assertEquals(null, $dictionary->key());
    }

    public function testEquals(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $dictionary = new Dictionary($data);

        $this->assertTrue($dictionary->equals(new Dictionary($data)));
        $this->assertTrue($dictionary->equals(new Dictionary([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ])));
        $this->assertFalse($dictionary->equals(new Dictionary([
            'key1' => 'value1',
            'key3' => 'value3',
        ])));
    }

    public function testRemoveIfKeyExists(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $dictionary = new Dictionary($data);
        $this->assertArrayHasKey('key2', $dictionary->getAll());
        $this->assertCount(3, $dictionary->getAll());
        $this->assertEquals($data, $dictionary->getAll());

        $dictionaryNew = $dictionary->remove('key2');
        $this->assertArrayNotHasKey('key2', $dictionaryNew->getAll());
        $this->assertCount(2, $dictionaryNew->getAll());
        $this->assertEquals([
            'key1' => 'value1',
            'key3' => 'value3',
        ], $dictionary->getAll());
    }

    public function testRemoveIfKeyDoesNotExist(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $dictionary = new Dictionary($data);
        $this->assertArrayNotHasKey('key4', $dictionary->getAll());
        $this->assertCount(3, $dictionary->getAll());
        $this->assertEquals($data, $dictionary->getAll());

        $dictionaryNew = $dictionary->remove('key4');
        $this->assertArrayNotHasKey('key4', $dictionaryNew->getAll());
        $this->assertCount(3, $dictionaryNew->getAll());
        $this->assertEquals($data, $dictionary->getAll());
    }

    public function testRemoveMultipleIfKeyExists(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        ];

        $dictionary = new Dictionary($data);
        $this->assertArrayHasKey('key2', $dictionary->getAll());
        $this->assertArrayHasKey('key4', $dictionary->getAll());
        $this->assertCount(4, $dictionary->getAll());
        $this->assertEquals($data, $dictionary->getAll());

        $dictionaryNew = $dictionary->remove('key2', 'key4');
        $this->assertArrayNotHasKey('key2', $dictionaryNew->getAll());
        $this->assertArrayNotHasKey('key4', $dictionaryNew->getAll());
        $this->assertCount(2, $dictionaryNew->getAll());
        $this->assertEquals([
            'key1' => 'value1',
            'key3' => 'value3',
        ], $dictionary->getAll());
    }

    public function testRemoveMultipleIfKeyDoesNotExist(): void
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        ];

        $dictionary = new Dictionary($data);
        $this->assertArrayNotHasKey('key5', $dictionary->getAll());
        $this->assertArrayNotHasKey('key6', $dictionary->getAll());
        $this->assertCount(4, $dictionary->getAll());
        $this->assertEquals($data, $dictionary->getAll());

        $dictionaryNew = $dictionary->remove('key5', 'key6');
        $this->assertArrayNotHasKey('key5', $dictionaryNew->getAll());
        $this->assertArrayNotHasKey('key6', $dictionaryNew->getAll());
        $this->assertCount(4, $dictionaryNew->getAll());
        $this->assertEquals($data, $dictionary->getAll());
    }

    public function testHasNotNullValue(): void
    {
        $dictionary = new Dictionary([
            'key1' => 'value',
            'key2' => null,
        ]);

        $this->assertTrue($dictionary->hasNotNullValue('key1'));
        $this->assertFalse($dictionary->hasNotNullValue('key2'));
    }

    public function testMerge(): void
    {
        $dictionary = new Dictionary([
            'key1'   => 'value1',
            'key2'   => 'value2',
            'nested' => [1,2,3]
        ]);
        $additionalDictionary = new Dictionary([
            'key3' => 'value3'
        ]);
        $result = [
            'key1'   => 'value1',
            'key2'   => 'value2',
            'nested' => [1,2,3],
            'key3'   => 'value3'
        ];
        $this->assertEquals($result, $dictionary->merge($additionalDictionary)->getAll());
    }

    public function testMergeSameValues(): void
    {
        $dictionary = new Dictionary([
            'key1'   => 'value1',
            'key2'   => 'value2'
        ]);
        $additionalDictionary = new Dictionary([
            'key2' => null
        ]);
        $result = [
            'key1'   => 'value1',
            'key2'   => null
        ];
        $this->assertEquals($result, $dictionary->merge($additionalDictionary)->getAll());
    }
}
