<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Electronic\Entity\Console;
use App\Domain\Electronic\Entity\Controller;
use App\Domain\Electronic\Entity\Microwave;
use App\Domain\Electronic\Entity\Television;
use App\Domain\Electronic\Extra;
use App\Domain\Electronic\TypeInterface;

class ElectronicItemFactory
{

    /**
     * @throws \Exception
     */
    public static function getItem(array $data = []): TypeInterface
    {
        if (!self::isValid($data)) {
            throw new \InvalidArgumentException('Invalid Arguments');
        }

        switch ($data['type']) {
            case "television":
                $electronicItem = new Television();
                break;
            case "console":
                $electronicItem = new Console();
                break;
            case "microwave":
                $electronicItem = new Microwave();
                break;
            case "controller":
                $electronicItem = new Controller();
                break;
            default:
                throw new \Exception("Unknown Electronic Type");
        }

        $electronicItem->setPrice($data['price']);
        $electronicItem->setAmount($data['amount']);
        $electronicItem->setType($data['type']);
        $electronicItem->setWired($data['wired']);
        $electronicItem->setTitle($data['title']);

        if (!isset($data['extra'])) {
            return $electronicItem;
        }

        $extra = new Extra();

        foreach ($data['extra'] as $item) {
            $extra->add(self::getItem($item));
        }
        $electronicItem->addExtra($extra);

        return $electronicItem;
    }

    public static function isValid(array $data): bool
    {
        return array_key_exists('price', $data) &&
            array_key_exists('type', $data) &&
            array_key_exists('amount', $data) &&
            array_key_exists('wired', $data) &&
            array_key_exists('title', $data);
    }
}
