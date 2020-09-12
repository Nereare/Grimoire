---
title: Example
layout: default

parent: Armor
grand_parent: Layouts Guide
nav_order: 1
---

# Armor Example

Here is an example of an empty armor item entry.

```yaml
---
title        : Armor Page Title
author       : Author Name
date         : 2020-09-12

item:
  name: Armor Name
  type: Heavy
  rarity: Very Rare
  attunement: by an evil character
  weight: 84 lb.
  value: 8,000
  ac:
    base: 18
    dex: 0
  str: 16
  stealth: true
  charges:
    number: 2
    reset: after a short rest
    regain: 1d4-2
  attributes:
    - Can cast thaumaturgy

layout: armor
---

# Description of the armor here.
```
