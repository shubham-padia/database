<?php

namespace Utopia\Tests\Validator\Query;

use PHPUnit\Framework\TestCase;
use Utopia\Database\Database;
use Utopia\Database\Document;
use Utopia\Database\Query;
use Utopia\Database\Validator\Query\Base;
use Utopia\Database\Validator\Query\Select;

class SelectTest extends TestCase
{
    protected Base|null $validator = null;

    public function setUp(): void
    {
        $this->validator = new Select(
            attributes: [
                new Document([
                    '$id' => 'attr',
                    'key' => 'attr',
                    'type' => Database::VAR_STRING,
                    'array' => false,
                ]),
            ],
        );
    }

    public function testValueSuccess(): void
    {
        $this->assertTrue($this->validator->isValid(Query::select(['*', 'attr'])));
    }

    public function testValueFailure(): void
    {
        $this->assertFalse($this->validator->isValid(Query::limit(1)));
        $this->assertEquals('bla', $this->validator->getDescription());
    }
}
