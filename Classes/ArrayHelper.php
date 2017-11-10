<?php

namespace PunktDe\Eel\ArrayHelper;

/*
 *  (c) 2017 punkt.de GmbH - Karlsruhe, Germany - http://punkt.de
 *  All rights reserved.
 */

use Neos\Eel\ProtectedContextAwareInterface;

class ArrayHelper implements ProtectedContextAwareInterface
{

    /**
     * Adds a key / value pair to an array
     *
     * @param array $array
     * @param string $key
     * @param $value
     * @return array
     */
    public function setKeyValue(array $array, string $key, $value): array
    {
        $array[$key] = $value;
        return $array;
    }

    /**
     * Exposes PHPs ksort function to Eel
     *
     * @param array $array
     * @return array
     */
    public function ksort(array $array): array {
        \ksort($array);
        return $array;
    }

    /**
     * @param string $methodName
     * @return bool
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
