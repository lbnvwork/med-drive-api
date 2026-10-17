<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Health\HealthReport;
use PHPUnit\Framework\TestCase;

final class HealthReportTest extends TestCase
{
    public function testReportsOkStatusAndVersion(): void
    {
        $report = new HealthReport('1.2.3');

        self::assertSame(['status' => 'ok', 'version' => '1.2.3'], $report->toArray());
    }

    public function testVersionDefaultsToDev(): void
    {
        self::assertSame('dev', (new HealthReport())->toArray()['version']);
    }
}
