---
title: Example
layout: default

parent: Settlement
grand_parent: Layouts Guide
nav_order: 1
---

# Settlement Example

Here is an example of an empty settlement entry.

```yaml
---
title              : Post Title
author             : Author Name
date               : 2019-08-19

settlement:
  name             : Cityville
  type             : Small City
  size             : 4 acres
  demographics:
    - race         : Human
      percent      : 70
    - race         : Half-elf
      percent      : 20
    - race         : Misc.
      percent      : 10
  population       : 1,000
  gp-limit         : 1,000
  wealth           : 10,000
  centres:
    - type         : Conventional Council
      name         : City Council
      align        : Lawful Good
  authorities:
    - class        : Warrior
      level        : 5
      title        : Constable
      name         : Urist McLeader

shops:
  - type           : Inn
    name           : The Prancing Pony
    owner:
      name         : Barliman Butterbur
      gender       : Male
      race         : Human
      class        : Commoner
      level        : 5
    prices:
      sell         : 120
      buy          : false
    location       : East Road
    desc           : A large wooden building with rooms for both humans and halflings alike.
    goods:
      name         : Specials
      list:
        - name     : Sausage Sandwich and a Tankard of Bitter
          cost     : 4sp
        - name     : Goose Soup with Peas
          cost     : 4sp
        - name     : Duck and a Glass of Brandy
          cost     : 4sp

houses:
  - type           : Small Cottage
    name           : ''
    location       : West Road, north of the hill
    desc           : A small wood building with only one room, filled to the brim with ale.
    people:
      - name       : Nob
        gender     : Male
        race       : Halfling
        class      : Commoner
        level      : 1
        owner      : true
      - name       : Bob
        gender     : Male
        race       : Halfling
        class      : Commoner
        level      : 1
    items:
      - name       : Money
        desc       : 2 gp, 11 sp and 45 cp

demographics:
  overview:
    nobles         : 31
    officers       : 11
    clergy         : 8
    freeholders    : 70
    citizens       : 876
    hirelings      : 4
  ruling-house:
    nobles         : 7
    relatives      : 3
    servants       : 1
    guards         : 2
    serjaants      : 1
  other-houses:
    houses         : 3
    population     : 24
  officers:
    reeves         : 1
    messors        : 1
    woodwards      : 1
    constables     : 1
    guards         : 7
  clergy:
    clerics        : 8
    priests        : 0
  freeholders:
    adventures     : 1
    apothecaries   : 0
    armourers      : 0
    artists        : 1
    butchers       : 1
    chandlers      : 2
    charcoalers    : 3
    cobblers       : 7
    entertainers   : 1
    foresters      : 1
    furriers       : 5
    glassworkers   : 1
    innkeepers     : 1
    jewelers       : 2
    litigants      : 1
    locksmiths     : 1
    masons         : 3
    metalsmiths    : 3
    bakers         : 5
    ostlers        : 1
    outfitters     : 0
    physicians     : 2
    potters        : 2
    roofers        : 1
    ropemakers     : 0
    sages          : 0
    salters        : 2
    scribes        : 1
    shipwrights    : 1
    tailors        : 5
    tanners        : 1
    taverners      : 2
    teamsters      : 0
    timberwrights  : 1
    tinkers        : 1
    vintners       : 1
    weaponcrafters : 2
    weavers        : 2
    woodcrafters   : 4
    yeomen         : 2
  buildings:
    mansions       : 4
    churches       : 2
    businesses     : 87
    municipal      : 1
    homes          : 126
    total          : 220

layout             : settlement
---

# Settlement description here.
```
