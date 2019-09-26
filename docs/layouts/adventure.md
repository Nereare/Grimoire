---
title: Adventure
layout: default

parent: Layouts Guide
nav_order: 1
has_children: true
---

# Adventure Layout

Aimed at documenting homebrewed adventures from the point-of-view of the Dungeon Master, use this when planning an adventure, so that all information regarding it is centralized.

This layout has two columns:

1. The left one contains fist-level header, author name and date. Under which sits the main content of the post - all that is not on the [front matter].
2. The right one shows the adventure metadata (all of which is under the `adventure` variable in the front matter) in a information box, below we list the metadata available to set and its requirement or lack thereof.

| Metadata            | Required?          | Type      | Description                                                                  |
|:-------------------:|:------------------:|:---------:|:-----------------------------------------------------------------------------|
| `name`              | :heavy_check_mark: | `string`  | The name of the adventure                                                    |
| `char-num`          | :heavy_check_mark: | `integer` | The number of player characters suggested for the adventure                  |
| `lvl`               | :heavy_check_mark: | `object`  | An object describing suggested levels, see below                             |
| `lvl.range`         | :heavy_check_mark: | `boolean` | `true` if designed for a range of levels (*e.g.* 1st-3rd), `false` otherwise |
| `lvl.min`           | :x:                | `string`  | Minimum PC level suggested (*e.g.* `3`), required if `lvl.range` is `true`   |
| `lvl.max`           | :x:                | `string`  | Maximum PC level suggested, required if `lvl.range` is `true`                |
| `lvl.lvl`           | :x:                | `string`  | PC level suggested, required if `lvl.range` is `false`                       |
| `max-xp`            | :heavy_check_mark: | `integer` | Maximum XP obtainable for the adventure                                      |
| `max-gp`            | :heavy_check_mark: | `integer` | Maximum gold obtainable for the adventure                                    |
| `encounters`        | :heavy_check_mark: | `integer` | Number of encounters available on the adventure                              |
| `type`              | :heavy_check_mark: | `string`  | Type of adventure (*e.g.* `Dungeon Delve`)                                   |
| `questline`         | :x:                | `object`  | An object describing the questline to which this adventure pertains          |
| `questline.name`    | :x:                | `string`  | The name of the questline or campaign                                        |
| `questline.chapter` | :x:                | `string`  | The chapter of the questline or campaign                                     |

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
