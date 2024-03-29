# Neos Eel helper for array handling

[![Latest Stable Version](https://poser.pugx.org/punktDe/eel-arrayhelper/v/stable)](https://packagist.org/packages/punktDe/eel-arrayhelper) [![Total Downloads](https://poser.pugx.org/punktDe/eel-arrayhelper/downloads)](https://packagist.org/packages/punktDe/eel-arrayhelper) [![License](https://poser.pugx.org/punktDe/eel-arrayhelper/license)](https://packagist.org/packages/punktDe/eel-arrayhelper)

## Installation

    composer require punktde/eel-arrayhelper

## Usage

This packages provides the methods:

**Sort by Key (ksort)**

    attributes = Neos.Fusion:RawArray
    attributes.@process.ksort = ${PunktDe.Array.ksort(value)}

**Sort by sub value**
    
      arrayToSort = [
       ['subValueKey' => "bb"]
       ['subValueKey' => "aa"]
      ]
     
      sorted = [
       ['subValueKey' => "aa"]
       ['subValueKey' => "bb"]
      ]
 
    attributes.@process.sortBySubValue = ${PunktDe.Array.sortBySubValue(value, 'subValueKey')}


**Filter arrays (array_filter)**

    attributes.@process.arrayFilter = ${PunktDe.Array.arrayFilter(value)}

**Array values (array_values)**

    attributes.@process.arrayValues = ${PunktDe.Array.arrayValues(value)}

**Array flip (array_flip)**

    attributes.@process.arrayFlip = ${PunktDe.Array.arrayFlip(value)}

**Add a key/value pair to an array**:

Can be used to add a value with a dynamic key

    attributes = Neos.Fusion:RawArray
    attributes.@process.addKV = ${PunktDe.Array.setKeyValue(value, 'key', 'value')}

**Extract Sub Elements**

This method extracts sub elements to the parent level.

    @process.extractSubElements = ${PunktDe.Array.extractSubElements(value)}

An input array of type:

    [
    element1 => [
        0 => 'value1'
    ],
    element2 => [
        0 => 'value2'
        1 => 'value3'
    ],

will be converted to:

    [
        0 => 'value1'
        1 => 'value2'
        2 => 'value3'
    ]

**Group Elements**

    @process.groupByKey = ${PunktDe.Array.groupByKey(value, 'group')}

Method can be used to convert an array of type
   
     [
         'element1' => [
              'name' => 'theName1',
              'group' => 'theGroup1',
         ],
         'element2' => [
              'name' => 'theName2',
              'group' => 'theGroup2',
         ],
         'element3' => [
              'name' => 'theName2',
              'group' => 'theGroup2',
         ],
    ]

into

    [
      'theGroup1' => [
         'element1' => [
              'name' => 'theName1',
              'group' => 'theGroup1',
         ],
     ],
    
     'theGroup2' => [
         'element2' => [
              'name' => 'theName2',
              'group' => 'theGroup2',
         ],
         'element3' => [
              'name' => 'theName2',
              'group' => 'theGroup2',
         ],
       ]
    ]

**Count elements (length)**

The method counts elements of a given array or a countable object.

    count = ${PunktDe.Array.length(this.rawCollection)}

**hasKey(array, key)**

    bool = ${PunktDe.Array.hasKey(array, key)}

**hasValue(array, key)**

    bool = ${PunktDe.Array.hasValue(array, key)}

**getValueByPath(array, path)**

Returns the value of a nested array by following the specified path.

    result = ${PunktDe.Array.getValueByPath(array, path)}

**setValueByPath(subject, path, value)**

Sets the given value in a nested array or object by following the specified path.

    array = ${PunktDe.Array.setValueByPath(subject, path, value)}

**unsetValue(key, array)**

Unset the value for the given key

    array = ${PunktDe.Array.unsetValue(key, array)}

## Sponsors & Contributors

The development of this package is sponsored by [punkt.de GmbH](https://punkt.de/en).
