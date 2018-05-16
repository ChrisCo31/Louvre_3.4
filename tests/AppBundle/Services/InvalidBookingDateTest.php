<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 16/05/2018
 * Time: 17:56
 */

namespace Tests\AppBundle\Services;


use Symfony\Bundle\TwigBundle\Tests\TestCase;
use AppBundle\Services\InvalidBookingDate;


class InvalidBookingDateTest extends TestCase
{
    public function testIsBankHoliday()
    {
        $day = new \DateTime();
        $invalidBookingDate = new InvalidBookingDate();
        $result = $invalidBookingDate->isBankHoliday($day);
        $this->assertFalse($result, 'Correspond à un jour férié');
    }
}
