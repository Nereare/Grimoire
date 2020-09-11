---
title: Example
layout: default

parent: Item
grand_parent: Layouts Guide
nav_order: 1
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
  rarity: Very Rare
  attunement: by a Small creature
  weight: 2 lb.
  value: 50.5
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
