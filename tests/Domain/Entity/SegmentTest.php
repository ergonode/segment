<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Segment\Tests\Domain\Entity;

use Ergonode\Segment\Domain\ValueObject\SegmentCode;
use Ergonode\Core\Domain\ValueObject\TranslatableString;
use Ergonode\Segment\Domain\Entity\Segment;
use Ergonode\Segment\Domain\Entity\SegmentId;
use Ergonode\Segment\Domain\ValueObject\SegmentStatus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 */
class SegmentTest extends TestCase
{
    /**
     * @var SegmentId|MockObject
     */
    private $id;

    /**
     * @var SegmentCode|MockObject
     */
    private $code;

    /**
     * @var TranslatableString|MockObject
     */
    private $name;

    /**
     * @var TranslatableString|MockObject
     */
    private $description;

    /**
     */
    protected function setUp()
    {
        $this->id = $this->createMock(SegmentId::class);
        $this->code = $this->createMock(SegmentCode::class);
        $this->name = $this->createMock(TranslatableString::class);
        $this->description = $this->createMock(TranslatableString::class);
    }

    /**
     * @throws \Exception
     */
    public function testSegmentCreation():void
    {
        /** @var TranslatableString $name */
        $name = $this->createMock(TranslatableString::class);
        /** @var TranslatableString $description */
        $description = $this->createMock(TranslatableString::class);
        /** @var SegmentStatus $name */
        $status = $this->createMock(SegmentStatus::class);

        $segment = new Segment($this->id, $this->code, $this->name, $this->description);
        $this->assertEquals($this->id, $segment->getId());
        $this->assertEquals($this->code, $segment->getCode());
        $this->assertEquals($this->name, $segment->getName());
        $this->assertEquals($this->description, $segment->getDescription());
        $this->assertEquals(new SegmentStatus(SegmentStatus::NEW), $segment->getStatus());
    }

    /**
     * @throws \Exception
     */
    public function testSegmentManipulation():void
    {
        /** @var TranslatableString|MockObject $name */
        $name = $this->createMock(TranslatableString::class);
        $name->method('isEqual')->willReturn(false);
        /** @var TranslatableString|MockObject $description */
        $description = $this->createMock(TranslatableString::class);
        $description->method('isEqual')->willReturn(false);
        /** @var SegmentStatus|MockObject $status */
        $status = $this->createMock(SegmentStatus::class);
        $status->method('isEqual')->willReturn(false);

        $segment = new Segment($this->id, $this->code, $this->name, $this->description);
        $segment->changeStatus($status);
        $segment->changeName($name);
        $segment->changeDescription($description);

        $this->assertSame($name, $segment->getName());
        $this->assertSame($description, $segment->getDescription());
        $this->assertSame($status, $segment->getStatus());
    }
}
