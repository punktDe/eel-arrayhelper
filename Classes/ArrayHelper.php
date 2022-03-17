<?php

namespace PunktDe\Eel\ArrayHelper;

/*
 *  (c) 2017 punkt.de GmbH - Karlsruhe, Germany - http://punkt.de
 *  All rights reserved.
 */

use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Utility\Arrays;

class ArrayHelper implements ProtectedContextAwareInterface
{
    /**
     * Adds a key / value pair to an array
     *
     * @param array $array The array
     * @param string $key The target key
     * @param mixed $value The value
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
     * arrayToSort = [
     *  ['subValueKey' => "bb"]
     *  ['subValueKey' => "aa"]
     * ]
     *
     * sorted = [
     *  ['subValueKey' => "aa"]
     *  ['subValueKey' => "bb"]
     * ]
     *
     * @param array $array
     * @param string $subValueKey
     * @return array
     */
    public function sortBySubValue(array $array, string $subValueKey): array
    {
        uasort($array, static function (array $elementA, array $elementB) use ($subValueKey) {
            return strcmp($elementA[$subValueKey], $elementB[$subValueKey]);
        });

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
     * @param array $array
     * @return array
     */
    public function arrayFlip(array $array): array
    {
        return array_flip($array);
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
     * @param array $array
     * @param string $key
     * @return bool
     */
    public function hasKey(array $array, string $key): bool
    {
        return isset($array[$key]);
    }

    /**
     * @param array $array
     * @param string $key
     * @return bool
     */
    public function hasValue(array $array, string $key): bool
    {
        return in_array($key, $array);
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
     * Returns the value of a nested array by following the specifed path.
     *
     * @param array &$array The array to traverse as a reference
     * @param array|string $path The path to follow. Either a simple array of keys or a string in the format 'foo.bar.baz'
     * @return mixed The value found, NULL if the path didn't exist (note there is no way to distinguish between a found NULL value and "path not found")
     * @throws \InvalidArgumentException
     */
    public function getValueByPath(array $array, $path)
    {
        return Arrays::getValueByPath($array, $path);
    }

    /**
     * Sets the given value in a nested array or object by following the specified path.
     *
     * @param array|\ArrayAccess $subject The array or ArrayAccess instance to work on
     * @param array|string $path The path to follow. Either a simple array of keys or a string in the format 'foo.bar.baz'
     * @param mixed $value The value to set
     * @return array|\ArrayAccess The modified array or object
     * @throws \InvalidArgumentException
     */
    public function setValueByPath($subject, $path, $value)
    {
        return Arrays::setValueByPath($subject, $path, $value);
    }

    /**
     * @param string|int $key
     * @param array $array
     * @return array
     */
    public function unsetValue($key, array $array): array
    {
        unset($array[$key]);
        return $array;
    }

    /**
     * Method can be used to convert an array of type
     * [
     *      'element1' => [
     *           'name' => 'theName1',
     *           'group' => 'theGroup1',
     *      ],
     *      'element2' => [
     *           'name' => 'theName2',
     *           'group' => 'theGroup2',
     *      ],
     * ]
     *
     * into
     *
     * [
     *   'theGroup1' => [
     *      'element1' => [
     *           'name' => 'theName1',
     *           'group' => 'theGroup1',
     *      ],
     *  ],
     *
     *  'theGroup2' => [
     *      'element2' => [
     *           'name' => 'theName2',
     *           'group' => 'theGroup2',
     *      ],
     *   ]
     * ]
     *
     *
     * @param array $subject
     * @param string $keyPath
     * @return array
     */
    public function groupByKey(array $subject, string $keyPath): array
    {
        $sortedArray = [];
        foreach ($subject as $key => $value) {
            $groupKey = Arrays::getValueByPath($value, $keyPath);
            $sortedArray = Arrays::setValueByPath($sortedArray, $groupKey . '.' . $key, $value);
        }
        return $sortedArray;
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
