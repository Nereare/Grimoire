---
title: 3.5e Example
layout: default

parent: Spell
grand_parent: Layouts Guide
nav_order: 1
---

# 3.5e Spell Example

Here is an example of an empty spell entry.

```yaml
---
title        : Post Title
author       : Author Name
date         : 2019-08-19

spell:
  name       : Hold Monster
  school     : Enchantment
  cast-time  : 1 standard action
  range      : Medium (100ft + 10ft/level)
  target     : One humanoid creature
  e35:
    subschool  : Compulsion
    descriptor : [Mind-Affecting]
    level      : [Brd 2, Clr 2, Sor/Wiz 3]
    components:
      list     : [V, S, F/DF]
      material : ''
      focus    : 'A small, straight piece of iron.'
      xp       : ''
    duration:
      desc     : 1 round/level (see text)
      dismiss  : true
    save:
      type     : Will
      effect   : negates
      harmless : false
    resistance : true

layout       : spell
---

# Spell description here.
```
