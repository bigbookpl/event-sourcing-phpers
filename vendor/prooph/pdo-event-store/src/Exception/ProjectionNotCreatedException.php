<?php
/**
 * This file is part of the prooph/pdo-event-store.
 * (c) 2016-2017 prooph software GmbH <contact@prooph.de>
 * (c) 2016-2017 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStore\Pdo\Exception;

class ProjectionNotCreatedException extends RuntimeException
{
    public static function with(string $projectionName): ProjectionNotCreatedException
    {
        return new self(sprintf('Projection "%s" was not created', $projectionName));
    }
}
