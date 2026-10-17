<?php

declare(strict_types=1);

namespace App\Controller;

use App\Health\HealthReport;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Smoke-эндпоинт каркаса: GET /health → {"status":"ok","version":"…"}.
 */
final class HealthController
{
    public function __construct(private readonly string $appVersion = 'dev')
    {
    }

    #[Route('/health', name: 'health', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $report = new HealthReport($this->appVersion);

        return new JsonResponse($report->toArray());
    }
}
