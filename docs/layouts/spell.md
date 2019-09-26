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

| Metadata              | Required?          | Type      | Description                                                                         |
|:---------------------:|:------------------:|:---------:|:------------------------------------------------------------------------------------|
| `name`                | :heavy_check_mark: | `string`  | The name of the spell                                                               |
| `school`              | :heavy_check_mark: | `string`  | The school of the spell                                                             |
| `subschool`           | :x:                | `string`  | The subschool of the spell, if any                                                  |
| `descriptor`          | :x:                | `array`   | An array of string, the descriptors of the spell, if any                            |
| `level`               | :heavy_check_mark: | `array`   | An array of the classes and levels (*e.g.* `Brd 2`) to which the spell is available |
| `components`          | :heavy_check_mark: | `object`  | An object pertaining the components of the spell                                    |
| `components.list`     | :heavy_check_mark: | `array`   | An array of strings of the spell's components (V, S, M, F/DF and XP)                |
| `components.material` | :x:                | `string`  | If there is any material component, its description (see below)                     |
| `components.focus`    | :x:                | `string`  | If there is any arcane focus component, its description (see below)                 |
| `components.xp`       | :x:                | `string`  | If there is any XP component, its description (see below)                           |
| `cast-time`           | :heavy_check_mark: | `string`  | The time it takes to cast the spell                                                 |
| `range`               | :heavy_check_mark: | `string`  | The range of the spell                                                              |
| `target`              | :heavy_check_mark: | `string`  | The target, effect or AoE of the spell                                              |
| `duration`            | :heavy_check_mark: | `object`  | An object pertaining to the duration of the spell                                   |
| `duration.desc`       | :heavy_check_mark: | `string`  | The duration of the spell                                                           |
| `duration.dismiss`    | :heavy_check_mark: | `boolean` | Whether or not the spell is dismissable by the caster                               |
| `save`                | :heavy_check_mark: | `object`  | An object of the saving throws of the spell, if any                                 |
| `save.type`           | :heavy_check_mark: | `string`  | The type of saving throw available, or `None`                                       |
| `save.effect`         | :x:                | `string`  | If there is a saving throw, what the success means                                  |
| `save.harmless`       | :x:                | `boolean` | Whether or not the spell is harmless to the target                                  |
| `resistance`          | :heavy_check_mark: | `boolean` | Whether or not the spell is subject to spell resistance                             |

## Components

Some spell have material components, arcane focuses or XP costs (*e.g.* [fireball](http://www.d20srd.org/srd/spells/fireball.htm)). If your spell is one such, you need not describe the required components in the body of text of the spell, this layout has it defined in the [front matter], as described above with the `components.material`, `components.focus`, and `components.xp` variables.

All of these are `string` variables that, when defined, will be rendered below the spell description, with an appropriate header.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
