---
title: Armor
layout: default

parent: Layouts Guide
nav_order: 12
has_children: true
---

# Armor Layout

This layout is aimed at documenting armor items.

This layout has two columns:

1. The left one contains the fist-level header, author name and date. Under which sits the description of the armor.
2. The right column contains game statistics, which must be defined in the [front matter].

| Metadata           | Required?          | Type                 | Description |
|:------------------:|:------------------:|:--------------------:|:------------|
| `name`             | :heavy_check_mark: | `string`             | Name of the item |
| `type`             | :heavy_check_mark: | `string`             | The type of item (*e.g.* Ring, Wondrous Item, Staff) |
| `rarity`           | :x:                | `string`             | The rarity of the item (*e.g.* Common, Artifact, Unique) |
| `attunement`       | :x:                | `string`             | What kind of creature may attune to the item, see below |
| `weight`           | :heavy_check_mark: | `string`             | The weight of the item, see below |
| `value`            | :heavy_check_mark: | `float` or `integer` | The base value of the item, in *gold pieces* |
| `ac`               | :heavy_check_mark: | `object`             | The Armor Class definitions |
| `ac.base`          | :heavy_check_mark: | `integer`            | The base value for the Armor Class |
| `ac.dex`           | :heavy_check_mark: | `integer`            | The maximum Dexterity bonus to the base AC, if not appliable, set to `0` |
| `str`              | :x:                | `integer`            | The minimum Strength score to wear this armor |
| `stealth`          | :x:                | `boolean`            | Whether or not this armor gives *disadvantage* on stealth rolls |
| `charges`          | :x:                | `object`             | An object containing the charge definitions |
| `charges.number`   | :heavy_check_mark: | `integer`            | The maximum number of charges |
| `charges.reset`    | :heavy_check_mark: | `string`             | The time at which the item regains charges, with preposition (*i.e.* `after a long rest`, not `long rest`) |
| `charges.regain`   | :heavy_check_mark: | `string`             | The number of charges regained after the reset condition (either an absolute number or a roll condition) |
| `attributes`       | :x:                | `array` of `string`s | A list of strings with metadata the item grants |

## Attunement

The `attunement` variable is optional. If you set it, keep in mind that:

1. The item will be considered to require attunement; and
2. The string you set will be prepended by `Requires attunement by ...`.

## Data with Units

If the metadata variable you are setting would have a spacial unit (*e.g.* `ft`, `mi`, `m`, `km`), you must give it into the variable, which will certainly be a `string`. Sadly, D&amp;D works under the archaic imperial system of units, should you want to convert everything under this layout, you may - and would make its owner very proud and happy in the process.

Variables pertaining to value need not be given `gp` after them, the layout deal with this.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
