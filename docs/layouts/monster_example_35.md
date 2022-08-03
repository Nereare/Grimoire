---
title: 3.5e Example
layout: default

parent: Monster
grand_parent: Layouts Guide
nav_order: 1
---

# 3.5e Monster Example

Here is an example of an empty monster entry.

```yaml
---
title        : Monster Page Title
author       : Author Name
date         : 2019-08-19

monster:
  name        : Terrasque
  size        : Colossal
  type        : Magical Beast
  subtype     : non-biped
  align       : always neutral
  abilities:
    str       : 45
    dex       : 16
    con       : 35
    int       : 3
    wis       : 14
    cha       : 14
  e35:
    ac:
      base      : 35
      desc      : -8 size, +3 Dex, +30 natural
      touch     : 5
      flat      : 32
    hp:
      hp        : 858
      hd        : 48d10 + 594
    speed       : 20ft
    initiative  : +7
    space       : 30ft
    reach       : 20ft
    saves:
      fort      : +38
      ref       : +29
      will      : +20
    skills      : Listen +17, Search +9, Spot +17, Survival +14 (+16 following tracks)
    feats       : Alertness, Awesome Blow, Blind-Fight, Cleave, Combat Reflexes, Dodge, Great Cleave, Improved Bull Rush, Improved Initiative, Iron Will, Power Attack, Toughness (6)
    cr          : 20
    treasure    : None
    advancement : 49+ HD (Colossal)
    lvl_adj     : N/A
    env         : Any
    org         : Solitary
    qualities   : Augmented critical, frightful presence, improved grab, rush, swallow whole
    sp_attacks  : Augmented critical, frightful presence, improved grab, rush, swallow whole
    attacks:
      - name    : Full Attack
        desc    : Bite +57 melee (4d8+17/18-20/×3) and 2 horns +52 melee (1d10+8) and 2 claws +52 melee (1d12+8) and tail slap +52 melee (3d8+8)
      - name    : Bite
        desc    : +57 melee (4d8+17/18-20/×3)
    possessions :
      - name    : Item
        desc    : Description

layout: monster
---

# Description of the monster here.
```
