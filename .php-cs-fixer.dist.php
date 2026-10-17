<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

/**
 * PHP CS Fixer — стиль бэкенда (задача 5.31).
 *
 * Ruleset: `@PSR12` + `@Symfony` (+ точечные правила команды).
 * Жёсткий режим: проверка — `vendor/bin/php-cs-fixer fix --dry-run --diff`
 * (шаг в CI включается в 5.34). Единоразовое приведение кода (`fix`) здесь
 * не применяется — это 5.34 (исполнитель Лид).
 *
 * Область: `src` (доменный код `Ibs\*`), `tests`, `migrations` — только
 * исходники проекта. Служебные `config/` (генерируемый `reference.php`,
 * `bundles.php`) и `bin/` (тонкие обёртки) не фиксируем.
 */
$finder = (new Finder())
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/migrations',
    ])
    ->exclude(['var'])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    // `declare_strict_types` — risky-правило (меняет поведение типизации),
    // поэтому risky-правила разрешаем осознанно.
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,
        'declare_strict_types' => true,
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline' => true,
    ])
    ->setFinder($finder);
