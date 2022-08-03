---
title: 5e Example
layout: default

parent: Monster
grand_parent: Layouts Guide
nav_order: 1
---

# 5e Monster Example

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
  e5:
    ac:
      base      : 35
      desc      : natural armor
    hp:
      hp        : 858
      hd        : 48d10 + 594
    speed:
    - 20 ft.
    - fly 60 ft.
    cr          : 20
    saves:
    - STR +30
    - CON +42
    skills:
    - Athletics +34
    - Survival +12
    dmg_vulnerabilities:
    - fire
    dmg_resistances:
    - cold
    - thunder
    dmg_immunities:
    - psychic
    cond_immunities:
    - grappled
    senses:
    - darkvision 120 ft.
    - passive Perception 12
    langs:
    - understands all but speaks none
    pb          : 8
    spellcasting:
      intro     : Lorem ipsum dolor sit amet
      list:
      - title : Cantrips
        list:
        - prestidigitation
        - ray of frost
    props:
      - title   : Title
        desc    : Lorem ipsum dolor sit amet
    actions:
      - title   : Actions
        list:
        - name    : Multiattack
          desc    : The creature makes four bite attacks
        - name    : Bite
          desc    : +57 melee (4d8+17/18-20/×3)
      - title   : Legendary Actions
        intro   : The creature can take 3 legendary actions, choosing from the options below. Only one legendary action can be used at a time and only at the end of another creature's turn. The creature regains spent legendary actions at the start of its turn.
        list:
        - name    : Attack
          desc    : The creature makes one bite attack

layout: monster
---

# Description of the monster here.
```
