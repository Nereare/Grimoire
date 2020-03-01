---
title: Example
layout: default

parent: Animal
grand_parent: Layouts Guide
nav_order: 1
---

# Animal Example

Here is an example of an empty animal entry.

```yaml
---
title      : Animal Name
author     : Author Name
date       : 2019-08-19

animal:
  species  : Animalia animalis
  linnaean :
    - Regio
    - Regnum
    - Phylum
    - Classis
    - Ordo
    - Familia
    - Genus
    - Species
  feeding  :
    type   : Autotroph
    subtype: Photosynthesizer
  sizes:
    type   : Wingspan
    unit   : cm
    min    : 80
    max    : 95
  weight   :
    unit   : kg
    min    : 3
    max    : 4
  habitat  :
    biome  : Coastal cliffs
    plane  : Prime Material
  # IUCN refer to the IUCN Red List classification, version 3.1, 2001.
  # Please, use the two-letter abbreviation.
  iucn     : LC

layout     : animal
---

# Animal content here.
```
