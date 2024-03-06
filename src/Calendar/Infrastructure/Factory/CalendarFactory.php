<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure\Factory;

use App\Calendar\Domain\Entity\Calendar;
use App\Calendar\Infrastructure\Repository\CalendarRepository;
use App\Shared\Domain\ValueObject\CalendarId;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Calendar>
 *
 * @method        Calendar|Proxy                     create(array|callable $attributes = [])
 * @method static Calendar|Proxy                     createOne(array $attributes = [])
 * @method static Calendar|Proxy                     find(object|array|mixed $criteria)
 * @method static Calendar|Proxy                     findOrCreate(array $attributes)
 * @method static Calendar|Proxy                     first(string $sortedField = 'id')
 * @method static Calendar|Proxy                     last(string $sortedField = 'id')
 * @method static Calendar|Proxy                     random(array $attributes = [])
 * @method static Calendar|Proxy                     randomOrCreate(array $attributes = []))
 * @method static CalendarRepository|RepositoryProxy repository()
 * @method static Calendar[]|Proxy[]                 all()
 * @method static Calendar[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Calendar[]&Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Calendar[]|Proxy[]                 findBy(array $attributes)
 * @method static Calendar[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = []))
 * @method static Calendar[]|Proxy[]                 randomSet(int $number, array $attributes = []))
 */
final class CalendarFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return ['CalendarId' => CalendarId::generate()];
    }

    protected static function getClass(): string
    {
        return Calendar::class;
    }
}
