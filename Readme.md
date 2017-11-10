# Neos Eel helper for array handling

Provides the methods:

**Add a key/value pair to an array**:

Can be used add a value with a dynamic key

    attributes = Neos.Fusion:RawArray
    attributes.@process.addKV = ${PunktDe.Array.setKeyValue(value, 'key', 'value')}
    
**Sort by Key**

    attributes = Neos.Fusion:RawArray
    attributes.@process.ksort = ${PunktDe.Array.ksort(value)}
