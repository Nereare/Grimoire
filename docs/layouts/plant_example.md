---
title: Example
layout: default

parent: Plant
grand_parent: Layouts Guide
nav_order: 1
---

# Plant Example

Here is an example of an empty plant entry.

```yaml
---
title      : Plant Name
author     : Author Name
date       : 2019-08-19

plant:
  species  : Herbidus planta
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
    type   : Height
    unit   : m
    min    : 4
    max    : 7
  habitat  :
    biome  : Coastal cliffs
    plane  : Prime Material
  # IUCN refer to the IUCN Red List classification, version 3.1, 2001.
  # Please, use the two-letter abbreviation.
  iucn     : LC
  domestic : true
  fruit    : Sporocarp-bearing
  seed     : Spore-bearing
  note     : Fine-cuisine delicacy

layout     : plant
---

# Plant content here.
```
