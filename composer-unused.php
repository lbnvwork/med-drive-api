<?php

declare(strict_types=1);

use ComposerUnused\ComposerUnused\Configuration\Configuration;
use ComposerUnused\ComposerUnused\Configuration\NamedFilter;

/*
 * symfony/yaml нужен Flex/рецептам и парсингу config/*.yaml в рантайме —
 * в коде напрямую не используется, поэтому исключаем из проверки.
 */
return static function (Configuration $config): Configuration {
    return $config->addNamedFilter(NamedFilter::fromString('symfony/yaml'));
};
