# Neos Eel helper for array handling

Provides the methods:

**Add a key/value pair to an array**:

Can be used to add a value with a dynamic key

    attributes = Neos.Fusion:RawArray
    attributes.@process.addKV = ${PunktDe.Array.setKeyValue(value, 'key', 'value')}
    
**Sort by Key**

    attributes = Neos.Fusion:RawArray
    attributes.@process.ksort = ${PunktDe.Array.ksort(value)}


**Extract Sub Elemets***

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
