<?php

declare(strict_types=1);

namespace App\Health;

/**
 * Состояние сервиса: отдаётся эндпоинтом /health и проверяется smoke-тестом каркаса.
 */
final readonly class HealthReport
{
    public function __construct(private string $version = 'dev')
    {
    }

    /**
     * @return array{status: string, version: string}
     */
    public function toArray(): array
    {
        return ['status' => 'ok', 'version' => $this->version];
    }
}
