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

| Metadata           | Required?          | Type                 | Description |
|:------------------:|:------------------:|:--------------------:|:------------|
| `name`             | :heavy_check_mark: | `string`             | Name of the creature |
| `size`             | :heavy_check_mark: | `string`             | The size of the creature (*e.g.* Huge, Medium) |
| `type`             | :heavy_check_mark: | `string`             | The type of creature (*e.g.* Aberration, Dragon) |
| `subtype`          | :x:                | `string`             | The subtype of the creature, if applicable |
| `align`            | :heavy_check_mark: | `string`             | The align, or lack thereof, of the creature |
| `abilities`        | :heavy_check_mark: | `object`             | An object containing the abilities of the creature |
| `abilities.str`    | :heavy_check_mark: | `integer`            | The Strength of the creature |
| `abilities.dex`    | :heavy_check_mark: | `integer`            | The Dexterity of the creature |
| `abilities.con`    | :heavy_check_mark: | `integer`            | The Constitution of the creature |
| `abilities.int`    | :heavy_check_mark: | `integer`            | The Intelligence of the creature |
| `abilities.wis`    | :heavy_check_mark: | `integer`            | The Wisdom of the creature |
| `abilities.cha`    | :heavy_check_mark: | `integer`            | The Charisma of the creature |

### 3.5e Specific Front Matter

| Metadata               | Required?          | Type                 | Description |
|:----------------------:|:------------------:|:--------------------:|:------------|
| `e35.ac`               | :heavy_check_mark: | `object`             | An object containing the Armor Class elements |
| `e35.ac.base`          | :heavy_check_mark: | `integer`            | The base AC value |
| `e35.ac.desc`          | :x:                | `string`             | The description of the base AC, when appliable (*e.g.* `+2 natural`) |
| `e35.ac.touch`         | :heavy_check_mark: | `integer`            | The touch AC value |
| `e35.ac.flat`          | :heavy_check_mark: | `integer`            | The flat-footed AC value |
| `e35.hp`               | :heavy_check_mark: | `object`             | An object containing the health elements of the creature |
| `e35.hp.hp`            | :heavy_check_mark: | `integer`            | The maximum hit points of the creature |
| `e35.hp.hd`            | :heavy_check_mark: | `string`             | The hit dice of the creature and any bonus (*e.g.* `10d8 + 15`) |
| `e35.speed`            | :heavy_check_mark: | `string`             | The speed of the creature (*e.g.* `30ft`) |
| `e35.initiative`       | :heavy_check_mark: | `integer`            | The initiative bonus of the creature |
| `e35.space`            | :heavy_check_mark: | `string`             | The space border occupied by the creature |
| `e35.reach`            | :heavy_check_mark: | `string`             | The reach of the creature |
| `e35.saves`            | :heavy_check_mark: | `object`             | An object containing the saving throw bonuses of the creature |
| `e35.saves.fort`       | :heavy_check_mark: | `integer`            | The Fortitude bonus of the creature |
| `e35.saves.ref`        | :heavy_check_mark: | `integer`            | The Reflex bonus of the creature |
| `e35.saves.will`       | :heavy_check_mark: | `integer`            | The Will bonus of the creature |
| `e35.skills`           | :x:                | `string`             | A string *list* of all skills of the creature and their bonuses |
| `e35.feats`            | :x:                | `strint`             | A string *list* of all feats of the creature |
| `e35.cr`               | :heavy_check_mark: | `integer`            | The Challenge Rating of the creature |
| `e35.treasure`         | :heavy_check_mark: | `string`             | The treasure the creature possess, or the lack thereof |
| `e35.advancement`      | :heavy_check_mark: | `string`             | Any advancements you may apply to the creature |
| `e35.lvl_adj`          | :heavy_check_mark: | `string`             | Any level adjustments for the creature |
| `e35.env`              | :heavy_check_mark: | `string`             | The environment of the creature |
| `e35.org`              | :heavy_check_mark: | `string`             | The type of organization of the creature (*e.g.* `Solitary`) |
| `e35.qualities`        | :x:                | `string`             | A string *list* of the special qualities of the creature |
| `e35.sp_attacks`       | :x:                | `string`             | A string *list* of the special attacks of the creature |
| `e35.attacks`          | :heavy_check_mark: | `array` of `object`s | An array of objects, each element being one attack, at least one element is required |
| `e35.attacks.name`     | :heavy_check_mark: | `string`             | The name of the attack |
| `e35.attacks.desc`     | :heavy_check_mark: | `string`             | The bonus to this attack, the damage and damage type |
| `e35.possessions`      | :x:                | `array` of `object`s | An array of objects, each element being a different item |
| `e35.possessions.name` | :heavy_check_mark: | `string`             | The name of the item |
| `e35.possessions.desc` | :heavy_check_mark: | `string`             | A short description of the item, and any bonus or ability it may grant the creature |

### 5e Specific Front Matter

| Metadata                 | Required?          | Type                 | Description |
|:------------------------:|:------------------:|:--------------------:|:------------|
| `e5.ac`                  | :heavy_check_mark: | `object`             | An object containing the Armor Class elements |
| `e5.ac.base`             | :heavy_check_mark: | `integer`            | The AC value |
| `e5.ac.desc`             | :x:                | `string`             | The description of the base AC, when appliable (*e.g.* `natural armor`) |
| `e5.hp`                  | :heavy_check_mark: | `object`             | An object containing the health elements of the creature |
| `e5.hp.hp`               | :heavy_check_mark: | `integer`            | The maximum (average) hit points of the creature |
| `e5.hp.hd`               | :heavy_check_mark: | `string`             | The hit dice of the creature and any bonus (*e.g.* `10d8 + 15`) |
| `e5.speed`               | :heavy_check_mark: | `array`              | An array of strings that must contains at least one item, the base speed |
| `e5.cr`                  | :heavy_check_mark: | `integer`            | The Challenge Rating of the creature, the layout will include the corresponding XP |
| `e5.saves`               | :heavy_check_mark: | `array`              | An array of the proficient saving throws of the creature and their bonuses |
| `e5.skills`              | :x:                | `array`              | An array of strings of all the proficient skills of the creature and their bonuses |
| `e5.dmg_vulnerabilities` | :x:                | `array`              | An array of strings of all damage types to which the creature is vulnerable |
| `e5.dmg_resistances`     | :x:                | `array`              | An array of strings of all damage types to which the creature is resistant |
| `e5.dmg_immunities`      | :x:                | `array`              | An array of strings of all damage types to which the creature is immune |
| `e5.cond_immunities`     | :x:                | `array`              | An array of strings of all conditions to which the creature is immune |
| `e5.senses`              | :heavy_check_mark: | `array`              | An array of strings of all the senses of the creature, with at least one item, the "passive Perception" |
| `e5.langs`               | :x:                | `array`              | An array of strings of each languange known to the creature, or a single element of a specific description |
| `e5.pb`                  | :heavy_check_mark: | `integer`            | The proficiency bonus for the creature |
| `e5.spellcasting`        | :x:                | `object`             | An object containing the data regarding the spellcasting ability of the creature |
| `e5.spellcasting.intro`  | :heavy_check_mark: | `string`             | The introductory explanation of the creature's spellcasting ability, to-hit bonus, save DC and other data |
| `e5.spellcasting.list`   | :heavy_check_mark: | `array` of `object`s | An array of objects, each representing one spell pool of the creature (see below) |
| `e5.props`               | :x:                | `array` of `object`s | An array of objects, each representing one trait, feature or special ability of the creature |
| `e5.actions`             | :x:                | `array` of `object`s | An array of objects, each element being one type or subtype of action (see below) |

#### Spellcasting

The `e5.spellcasting.list` is an array of objects, each of which must include the following indexes:

| Index          | Required?          | Type         | Description |
|:--------------:|:------------------:|:------------:|:-----------:|
| `title`        | :heavy_check_mark: | `string`     | The frequency or pool from which the creature can draw the associated spell list |
| `list`         | :heavy_check_mark: | `array`      | An array of strings, each element (there **must** be at least one) one spell |

#### Actions

Each action element in an object that can and/or must include the following indexes:

| Index          | Required?          | Type         | Description |
|:--------------:|:------------------:|:------------:|:-----------:|
| `title`        | :heavy_check_mark: | `string`     | The title of the section, which will be displayed above the elements (*e.g.* "Actions" or "Mythic Actions") |
| `intro`        | :x:                | `string`     | Some action sections can (or must) include an introduction, such as with "Legendary Actions", this index offers just that |
| `list`         | :heavy_check_mark: | `array`      | An array of objects, each one entry below the section |

Each entry in the `list` index above is an object with two **required** indexes:

| Index          | Required?          | Type         | Description |
|:--------------:|:------------------:|:------------:|:-----------:|
| `name`         | :heavy_check_mark: | `string`     | The name of the action |
| `desc`         | :heavy_check_mark: | `string`     | The description of the action |

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
