---
title: 5e Example
layout: default

parent: Weapon
grand_parent: Layouts Guide
nav_order: 2
---

# 5e Weapon Example

Here is an example of an empty weapon item entry.

```yaml
---
title        : Weapon Page Title
author       : Author Name
date         : 2020-09-11

item:
  name: Weapon Name
  type: Ranged
  weight: 2 lb.
  value: 50.5
  damage:
    - 1d12 bludgeoning
  e5:
    rarity: Very Rare
    attunement: by a Small creature
    charges:
      number: 5
      reset: at dawn
      regain: 1d6
  props:
    - Finesse
    - Thrown (range 120/4.000)
  attributes:
    - +1 Attack roll
    - Resistance to psychic damage

layout: weapon
---

# Description of the weapon here.
```
