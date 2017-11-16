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
    public function ksort(array $array): array
    {
        \ksort($array);
        return $array;
    }


    /**
     * PHPs array_filter
     *
     * @param array $array
     * @return array
     */
    public function arrayFilter(array $array): array
    {
        return array_filter($array);
    }

    /**
     * Return array values
     *
     * @param array $array
     * @return array
     */
    public function arrayValues(array $array): array
    {
        return array_values($array);
    }

    /**
     * This method extracts sub elements to the parent level.
     *
     * An input array of type:
     * [
     *  element1 => [
     *    0 => 'value1'
     *  ],
     *  element2 => [
     *    0 => 'value2'
     *    1 => 'value3'
     *  ],
     *
     * will be converted to:
     * [
     *    0 => 'value1'
     *    1 => 'value2'
     *    2 => 'value3'
     * ]
     *
     * @param array $array
     * @param bool $preserveKeys
     * @return array
     */
    public function extractSubElements(array $array, bool $preserveKeys = false): array
    {
        $resultArray = [];

        foreach ($array as $element) {
            if (is_array($element)) {
                foreach ($element as $subKey => $subElement) {
                    if ($preserveKeys) {
                        $resultArray[$subKey] = $subElement;
                    } else {
                        $resultArray[] = $subElement;
                    }
                }
            } else {
                $resultArray[] = $element;
            }
        }

        return $resultArray;
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
