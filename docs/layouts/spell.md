---
title: Spell
layout: default

parent: Layouts Guide
nav_order: 6
has_children: true
---

# Spell Layout

This layout is aimed at documenting non-epic homebrewed spells, in a similar format as that of the [SRD] (*e.g.* [hold monster](http://www.d20srd.org/srd/spells/holdMonster.htm)).

This layout has only column, which contains the first-level header, author name, date, spell metadata, contents and, below all, miscellaneous costs.

| Metadata              | Required?          | Type      | Description |
|:---------------------:|:------------------:|:---------:|:------------|
| `name`                | :heavy_check_mark: | `string`  | The name of the spell |
| `school`              | :heavy_check_mark: | `string`  | The school of the spell |
| `cast-time`           | :heavy_check_mark: | `string`  | The time it takes to cast the spell |
| `range`               | :heavy_check_mark: | `string`  | The range of the spell |
| `target`              | :heavy_check_mark: | `string`  | The target, effect or AoE of the spell |

### 3.5e Specific Front Matter

| Metadata                  | Required?          | Type      | Description |
|:-------------------------:|:------------------:|:---------:|:------------|
| `e35.subschool`           | :x:                | `string`  | The subschool of the spell, if any |
| `e35.descriptor`          | :x:                | `array`   | An array of string, the descriptors of the spell, if any |
| `e35.level`               | :heavy_check_mark: | `array`   | An array of the classes and levels (*e.g.* `Brd 2`) to which the spell is available |
| `e35.components`          | :heavy_check_mark: | `object`  | An object pertaining the components of the spell |
| `e35.components.list`     | :heavy_check_mark: | `array`   | An array of strings of the spell's components (V, S, M, F/DF and XP) |
| `e35.components.material` | :x:                | `string`  | If there is any material component, its description (see below) |
| `e35.components.focus`    | :x:                | `string`  | If there is any arcane focus component, its description (see below) |
| `e35.components.xp`       | :x:                | `string`  | If there is any XP component, its description (see below) |
| `e35.duration`            | :heavy_check_mark: | `object`  | An object pertaining to the duration of the spell |
| `e35.duration.desc`       | :heavy_check_mark: | `string`  | The duration of the spell |
| `e35.duration.dismiss`    | :heavy_check_mark: | `boolean` | Whether or not the spell is dismissable by the caster |
| `e35.save`                | :heavy_check_mark: | `object`  | An object of the saving throws of the spell, if any |
| `e35.save.type`           | :heavy_check_mark: | `string`  | The type of saving throw available, or `None` |
| `e35.save.effect`         | :x:                | `string`  | If there is a saving throw, what the success means |
| `e35.save.harmless`       | :x:                | `boolean` | Whether or not the spell is harmless to the target |
| `e35.resistance`          | :heavy_check_mark: | `boolean` | Whether or not the spell is subject to spell resistance |

#### Components

Some spell have material components, arcane focuses or XP costs (*e.g.* [fireball](http://www.d20srd.org/srd/spells/fireball.htm)). If your spell is one such, you need not describe the required components in the body of text of the spell, this layout has it defined in the [front matter], as described above with the `components.material`, `components.focus`, and `components.xp` variables.

All of these are `string` variables that, when defined, will be rendered below the spell description, with an appropriate header.

### 5e Specific Front Matter

| Metadata                 | Required?          | Type      | Description |
|:---------------------:|:------------------:|:---------:|:------------|
| `e5.level`               | :heavy_check_mark: | `integer` | The level of the spell |
| `e5.classes`             | :x:                | `array`   | An array of strings, the classes to which the spell is available |
| `e5.subclasses`          | :x:                | `array`   | An array of strings, the subclasses to which the spell is available |
| `e5.components`          | :heavy_check_mark: | `object`  | An object pertaining the components of the spell |
| `e5.components.list`     | :heavy_check_mark: | `array`   | An array of strings of the spell's components (V, S, M, and F) |
| `e5.components.material` | :x:                | `string`  | The description of the material components for the spell, if any |
| `e5.components.consumed` | :x:                | `boolean` | If the material component above is consumed by the spell, defaults to `false` |
| `e5.duration`            | :heavy_check_mark: | `string`  | The duration of the spell |
| `e5.save`                | :x:                | `string`  | The save for avoiding the spell (one of `STR`, `DEX`, `CON`, `WIS`, `INT`, or `CHA`), if any |

#### Level

For 5th Edition, there is the (as of yet) homebrewed concept of 10th, 11th, and 12th-level spell, what was the concept of Epic Spells for 3.5e.

For 5e, this model should be, as of now, applicable equally for those.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
