---
title: Monster
layout: default

parent: Layouts Guide
nav_order: 3
has_children: true
---

# Monster Layout

This layout is aimed at documenting monsters and creatures of any kind. This may somewhat serve even as a PC/NPC sheet, although it is not its main intent.

This layout has two columns:

1. The left one contains the fist-level header, author name and date. Under which sits the description of the creature, its habits and tactics - everything but its game statistics.
2. The right column contains its game statistics, which must be defined in the [front matter].

| Metadata           | Required?          | Type                 | Description                                                                          |
|:------------------:|:------------------:|:--------------------:|:-------------------------------------------------------------------------------------|
| `name`             | :heavy_check_mark: | `string`             | Name of the creature                                                                 |
| `size`             | :heavy_check_mark: | `string`             | The size of the creature (*e.g.* Huge, Medium)                                       |
| `type`             | :heavy_check_mark: | `string`             | The type of creature (*e.g.* Aberration, Dragon)                                     |
| `align`            | :heavy_check_mark: | `string`             | The align, or lack thereof, of the creature                                          |
| `ac`               | :heavy_check_mark: | `object`             | An object containing the Armor Class elements                                        |
| `ac.base`          | :heavy_check_mark: | `integer`            | The base AC value                                                                    |
| `ac.desc`          | :x:                | `string`             | The description of the base AC, when appliable (*e.g.* `+2 natural`)                 |
| `ac.touch`         | :heavy_check_mark: | `integer`            | The touch AC value                                                                   |
| `ac.flat`          | :heavy_check_mark: | `integer`            | The flat-footed AC value                                                             |
| `hp`               | :heavy_check_mark: | `object`             | An object containing the health elements of the creature                             |
| `hp.hp`            | :heavy_check_mark: | `integer`            | The maximum hit points of the creature                                               |
| `hp.hd`            | :heavy_check_mark: | `string`             | The hit dice of the creature and any bonus (*e.g.* `10d8 + 15`)                      |
| `speed`            | :heavy_check_mark: | `string`             | The speed of the creature (*e.g.* `30ft`)                                            |
| `initiative`       | :heavy_check_mark: | `integer`            | The initiative bonus of the creature                                                 |
| `space`            | :heavy_check_mark: | `string`             | The space border occupied by the creature                                            |
| `reach`            | :heavy_check_mark: | `string`             | The reach of the creature                                                            |
| `saves`            | :heavy_check_mark: | `object`             | An object containing the saving throw bonuses of the creature                        |
| `saves.fort`       | :heavy_check_mark: | `integer`            | The Fortitude bonus of the creature                                                  |
| `saves.ref`        | :heavy_check_mark: | `integer`            | The Reflex bonus of the creature                                                     |
| `saves.will`       | :heavy_check_mark: | `integer`            | The Will bonus of the creature                                                       |
| `abilities`        | :heavy_check_mark: | `object`             | An object containing the abilities of the creature                                   |
| `abilities.str`    | :heavy_check_mark: | `integer`            | The Strength of the creature                                                         |
| `abilities.dex`    | :heavy_check_mark: | `integer`            | The Dexterity of the creature                                                        |
| `abilities.con`    | :heavy_check_mark: | `integer`            | The Constitution of the creature                                                     |
| `abilities.int`    | :heavy_check_mark: | `integer`            | The Intelligence of the creature                                                     |
| `abilities.wis`    | :heavy_check_mark: | `integer`            | The Wisdom of the creature                                                           |
| `abilities.cha`    | :heavy_check_mark: | `integer`            | The Charisma of the creature                                                         |
| `skills`           | :x:                | `string`             | A string *list* of all skills of the creature and their bonuses                      |
| `feats`            | :x:                | `strint`             | A string *list* of all feats of the creature                                         |
| `cr`               | :heavy_check_mark: | `integer`            | The Challenge Rating of the creature                                                 |
| `treasure`         | :heavy_check_mark: | `string`             | The treasure the creature possess, or the lack thereof                               |
| `advancement`      | :heavy_check_mark: | `string`             | Any advancements you may apply to the creature                                       |
| `lvl_adj`          | :heavy_check_mark: | `string`             | Any level adjustments for the creature                                               |
| `env`              | :heavy_check_mark: | `string`             | The environment of the creature                                                      |
| `org`              | :heavy_check_mark: | `string`             | The type of organization of the creature (*e.g.* `Solitary`)                         |
| `qualities`        | :x:                | `string`             | A string *list* of the special qualities of the creature                             |
| `sp_attacks`       | :x:                | `string`             | A string *list* of the special attacks of the creature                               |
| `attacks`          | :heavy_check_mark: | `array` of `object`s | An array of objects, each element being one attack, at least one element is required |
| `attacks.name`     | :heavy_check_mark: | `string`             | The name of the attack                                                               |
| `attacks.desc`     | :heavy_check_mark: | `string`             | The bonus to this attack, the damage and damage type                                 |
| `possessions`      | :x:                | `array` of `object`s | An array of objects, each element being a different item                             |
| `possessions.name` | :heavy_check_mark: | `string`             | The name of the item                                                                 |
| `possessions.desc` | :heavy_check_mark: | `string`             | A short description of the item, and any bonus or ability it may grant the creature  |

## Data with Units

If the metadata variable you are setting would have a spacial unit (*e.g.* `ft`, `mi`, `m`, `km`), you must give it into the variable, which will certainly be a `string`. Sadly, D&amp;D works under the archaic imperial system of units, should you want to convert everything under this layout, you may - and would make its owner very proud and happy in the process.

Variables pertaining to hit points need not be given `hp` after them, the layout deal with them.

## Abilities

Each ability variable must be only the base value, the raw score. The layout calculates and appends the modifiers on its own.

## String Lists

Some of the variables are `string`s, but they contain a list. What this means is that, eventhough it is a list, the layout does not iterate through it, the list is just outputted as a string. So, write a simple list, not an array.

## Arrays of Objects

These elements contain an array of objects, which are iterated through the layout.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
