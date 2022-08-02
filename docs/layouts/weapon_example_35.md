---
title: 3.5e Example
layout: default

parent: Weapon
grand_parent: Layouts Guide
nav_order: 1
---

# 3.5e Weapon Example

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
  e35:
    critical: &times;3
    range: 10ft.
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
