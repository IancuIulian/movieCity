<?php
declare(strict_types = 1);

namespace Util;


use Collection\Collection;

class Util
{

    static function collectionToArray(Collection $collection): array
    {
        $returnArray = [];

        foreach ($collection as $item){
            $returnArray[] = $item;
        }

        return $returnArray;
    }

    static function validEmailFormat(string $input): bool
    {
        preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/u', $input, $matches);
        if (empty($matches) || $input !== $matches[0]){
            return false;
        }
        return true;
    }
}