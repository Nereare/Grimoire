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
  - title          : Overview
    desc:
    - title        : Nobles
      qtt          : 31
    - title        : Officers
      qtt          : 11
    - title        : Clergy
      qtt          : 8
    - title        : Freeholders
      qtt          : 70
    - title        : Citizens
      qtt          : 876
    - title        : Hirelings
      qtt          : 4
  - title          : Ruling House
    desc:
    - title        : Nobles
      qtt          : 7
    - title        : Relatives
      qtt          : 3
    - title        : Servants
      qtt          : 1
    - title        : Guards
      qtt          : 2
    - title        : Serjaants
      qtt          : 1
  - title          : Nobility
    desc:
    - title        : Other Houses
      qtt          : 3
    - title        : Total Population
      qtt          : 24
  - title          : Officers
    desc:
    - title        : Reeves
      qtt          : 1
    - title        : Messors
      qtt          : 1
    - title        : Woodwards
      qtt          : 1
    - title        : Constables
      qtt          : 1
    - title        : Guards
      qtt          : 7
  - title          : Clergy
    desc:
    - title        : Clerics
      qtt          : 8
    - title        : Priests
      qtt          : 0
  - title          : Freeholders
    desc:
    - title        : Adventures
      qtt          : 1
    - title        : Apothecaries
      qtt          : 0
    - title        : Armourers
      qtt          : 0
    - title        : Artists
      qtt          : 1
    - title        : Butchers
      qtt          : 1
    - title        : Chandlers
      qtt          : 2
    - title        : Charcoalers
      qtt          : 3
    - title        : Cobblers
      qtt          : 7
    - title        : Entertainers
      qtt          : 1
    - title        : Foresters
      qtt          : 1
    - title        : Furriers
      qtt          : 5
    - title        : Glassworkers
      qtt          : 1
    - title        : Innkeepers
      qtt          : 1
    - title        : Jewelers
      qtt          : 2
    - title        : Litigants
      qtt          : 1
    - title        : Locksmiths
      qtt          : 1
    - title        : Masons
      qtt          : 3
    - title        : Metalsmiths
      qtt          : 3
    - title        : Bakers
      qtt          : 5
    - title        : Ostlers
      qtt          : 1
    - title        : Outfitters
      qtt          : 0
    - title        : Physicians
      qtt          : 2
    - title        : Potters
      qtt          : 2
    - title        : Roofers
      qtt          : 1
    - title        : Ropemakers
      qtt          : 0
    - title        : Sages
      qtt          : 0
    - title        : Salters
      qtt          : 2
    - title        : Scribes
      qtt          : 1
    - title        : Shipwrights
      qtt          : 1
    - title        : Tailors
      qtt          : 5
    - title        : Tanners
      qtt          : 1
    - title        : Taverners
      qtt          : 2
    - title        : Teamsters
      qtt          : 0
    - title        : Timberwrights
      qtt          : 1
    - title        : Tinkers
      qtt          : 1
    - title        : Vintners
      qtt          : 1
    - title        : Weaponcrafters
      qtt          : 2
    - title        : Weavers
      qtt          : 2
    - title        : Woodcrafters
      qtt          : 4
    - title        : Yeomen
      qtt          : 2

buildings:
  - title        : Mansions
    qtt          : 4
  - title        : Churches
    qtt          : 2
  - title        : Businesses
    qtt          : 87
  - title        : Municipal
    qtt          : 1
  - title        : Homes
    qtt          : 126
  - title        : Total
    qtt          : 220

layout             : settlement
---

# Settlement description here.
```
