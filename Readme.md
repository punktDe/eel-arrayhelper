# Neos Eel helper for array handling

[![Latest Stable Version](https://poser.pugx.org/punktDe/eel-arrayhelper/v/stable)](https://packagist.org/packages/punktDe/eel-arrayhelper) [![Total Downloads](https://poser.pugx.org/punktDe/eel-arrayhelper/downloads)](https://packagist.org/packages/punktDe/eel-arrayhelper) [![License](https://poser.pugx.org/punktDe/eel-arrayhelper/license)](https://packagist.org/packages/punktDe/eel-arrayhelper)

This packages provides the methods:

**Sort by Key (ksort)**

    attributes = Neos.Fusion:RawArray
    attributes.@process.ksort = ${PunktDe.Array.ksort(value)}

**Filter arrays (array_filter)**

    attributes.@process.arrayFilter = ${PunktDe.Array.arrayFilter(value)}

**Array values (array_values)**

    attributes.@process.arrayValues = ${PunktDe.Array.arrayValues(value)}

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

**Count elements (length)**

The method counts elements of a given array or a countable object.

    count = ${PunktDe.Array.length(this.rawCollection)}

## Sponsors & Contributors

The development of this package is sponsored by [punkt.de GmbH](https://punkt.de/en).
