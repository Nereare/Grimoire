---
title: Example
layout: default

parent: Spell
grand_parent: Layouts Guide
nav_order: 1
---

# Spell Example

Here is an example of an empty spell entry.

```yaml
---
title        : Post Title
author       : Author Name
date         : 2019-08-19

spell:
  name       : Hold Monster
  school     : Enchantment
  cast-time  : 1 minute
  range      : 120ft
  target     : One living humanoid
  e5:
    level      : 2
    classes    : [Bard, Sorcerer, Wizard]
    subclasses : [Arcana Cleric]
    components:
      list     : [V, S, M]
      material : 'a quarter pound of fish gills'
      consumed : false
    duration   : 1 hour
    save       : CHA

layout       : spell
---

# Spell description here.
```
