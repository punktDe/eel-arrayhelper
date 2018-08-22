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
     * Join the given array recursively
     * using the given glue string.
     *
     * @param array $array
     * @param string $glue
     * @return string
     */
    public function joinRecursive(array $array, string $glue): string
    {
        $result = '';

        foreach ($array as $item) {
            if (is_array($item)) {
                $result .= $this->joinRecursive($item, $glue) . $glue;
            } else {
                $result .= $item . $glue;
            }
        }

        $result = substr($result, 0, 0 - strlen($glue));

        return $result;
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
     * The method counts elements of a given array or countable object
     *
     * @param $countableObject
     * @return int
     * @throws \Exception
     */
    public function length($countableObject): int
    {
        if ($countableObject instanceof \Countable) {
            return $countableObject->count();
        }

        if (is_array($countableObject)) {
            return count($countableObject);
        }

        throw new \Exception('The given object was neither an array nor does it implement the Countable interface', 1529670013);
    }

    /**
     * @param array $a
     * @param array $b
     * @return array
     */
    public function intersect(array $a, array $b): array
    {
        return call_user_func_array('array_intersect', func_get_args());
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
