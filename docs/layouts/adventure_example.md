---
title: Example
layout: default

parent: Adventure
grand_parent: Layouts Guide
nav_order: 1
---

# Adventure Example

Here is an example of an empty adventure entry.

```yaml
---
title        : Post Title
author       : Author Name
date         : 2019-08-19

adventure:
  name       : Adventure Name
  char-num   : 4
  lvl:
    range    : true
    min      : 1
    max      : 3
    lvl      : 4
  max-xp     : 2,000
  max-gp     : 12,000
  encounters : 5
  type       : Dungeon Delve
  questline:
    name     : The Chills
    chapter  : 8

layout       : adventure
---

# Adventure content here.
```
