---
title: Example
layout: default

parent: Item
grand_parent: Layouts Guide
nav_order: 2
---

# Item Example

Here is an example of an empty item entry.

```yaml
---
title        : Item Page Title
author       : Author Name
date         : 2020-09-11

item:
  name: Item Name
  type: Ring
  weight: 2 lb.
  value: 50.5
  e5:
    rarity: Very Rare
    attunement: by a Small creature
    charges:
      number: 5
      reset: at dawn
      regain: 1d6
  attributes:
    - Advantage on Wisdom saving throws
    - +2 AC

layout: item
---

# Description of the item here.
```
