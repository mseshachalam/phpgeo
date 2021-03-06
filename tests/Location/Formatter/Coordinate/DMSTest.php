<?php

namespace Location\Formatter\Coordinate;

use Location\Coordinate;

class DMSTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DMS
     */
    protected $formatter;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->formatter = new DMS;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Location\Formatter\DMS::format
     */
    public function testFormatDefaultSeparator()
    {
        $coordinate = new Coordinate(52.5, 13.5);

        $this->assertEquals("52° 30′ 00″ 013° 30′ 00″", $this->formatter->format($coordinate));
    }

    /**
     * @covers Location\Formatter\DMS::format
     */
    public function testFormatCustomSeparator()
    {
        $coordinate = new Coordinate(18.911306, -155.678268);

        $this->formatter->setSeparator(", ");

        $this->assertEquals("18° 54′ 41″, -155° 40′ 42″", $this->formatter->format($coordinate));
    }

    /**
     * @covers Location\Formatter\DMS::format
     */
    public function testFormatCardinalLetters()
    {
        $coordinate = new Coordinate(18.911306, -155.678268);

        $this->formatter->setSeparator(", ")->useCardinalLetters(true);

        $this->assertEquals("18° 54′ 41″ N, 155° 40′ 42″ W", $this->formatter->format($coordinate));
    }

    /**
     * @covers Location\Formatter\DMS::format
     */
    public function testFormatBothNegative()
    {
        $coordinate = new Coordinate(-18.911306, -155.678268);

        $this->formatter->setSeparator(", ");

        $this->assertEquals("-18° 54′ 41″, -155° 40′ 42″", $this->formatter->format($coordinate));
    }

    /**
     * @covers Location\Formatter\DMS::format
     */
    public function testFormatASCIIUnits()
    {
        $coordinate = new Coordinate(-18.911306, -155.678268);

        $this->formatter->setSeparator(", ")->setUnits(DMS::UNITS_ASCII);

        $this->assertEquals("-18° 54' 41\", -155° 40' 42\"", $this->formatter->format($coordinate));
    }
}
