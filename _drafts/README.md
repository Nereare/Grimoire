# Writing a Post

So, I see you feel ready to write a post! That's amazing! :smile:

Please do note that this template has some special [collections](https://jekyllrb.com/docs/collections/), aimed at RPG-oriented resources. Each collection has a **template** model, which we strongly suggest you copy and fill with your creation.

After you created what you want, you must move your creation to the adequate folder.

| Collection | Sub-folder    | Layout      | Description                                                        |
|:----------:|:-------------:|:-----------:|:-------------------------------------------------------------------|
| Adventures | `_adventures` | `adventure` | Each individual adventure, with all its data, encounters and steps |
| Monsters   | `_monsters`   | `monster`   | Individual monsters, NPCs, PCs or other creatures                  |
| Spells     | `_spells`     | `spell`     | Non-epic spells of any class and nature                            |

## Common Aspects

### File Names

We ask that each file be named according to [Jekyll] [convention to post names](https://jekyllrb.com/docs/posts/), with its [date](http://xkcd.com/1179/) of writing or finishing, as you see fit, and its title without special characters and accents, and all whitespaces replaced by hyphens (`-`), in the form: `YYYY-MM-DD-title-without-spaces.md`

### Common Front Matter

All files must have [front matter] defined in its top. Below we will discuss specifics for each collection, but all of them has some common elements:

| Variable | Description                                                      |
|:--------:|:-----------------------------------------------------------------|
| `title`  | The title with all possible UTF-8 characters                     |
| `author` | Your name                                                        |
| `date`   | The same date as in the filename, following [ISO 8601]'s format  |
| `layout` | One of the layouts available - please don't alter the template's |

All metadata above **is required**.

All layouts will output, under the first-level header (`h1`), both the author name and the date.

## Individualities

Each layout has specialized [front matter], which is used by the layout on display. Here we discuss each of them.

### Adventure Layout

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
| `lvl.min`           | :x:                | `string`  | Minimum PC level suggested (*e.g.* `3rd`), required if `lvl.range` is `true` |
| `lvl.max`           | :x:                | `string`  | Maximum PC level suggested, required if `lvl.range` is `true`                |
| `lvl.lvl`           | :x:                | `string`  | PC level suggested, required if `lvl.range` is `false`                       |
| `max-xp`            | :heavy_check_mark: | `integer` | Maximum XP obtainable for the adventure                                      |
| `max-gp`            | :heavy_check_mark: | `integer` | Maximum gold obtainable for the adventure                                    |
| `encounters`        | :heavy_check_mark: | `integer` | Number of encounters available on the adventure                              |
| `type`              | :heavy_check_mark: | `string`  | Type of adventure (*e.g.* `Dungeon Delve`)                                   |
| `questline`         | :x:                | `object`  | An object describing the questline to which this adventure pertains          |
| `questline.name`    | :x:                | `string`  | The name of the questline or campaign                                        |
| `questline.chapter` | :x:                | `string`  | The chapter of the questline or campaign                                     |

<!--
TODO Make monster layout tutorial
BODY Create the tutorial for using the monster layout.
-->

### Post Layout

This is a generic layout, aimed at [Jekyll]'s posts. We suggest using this layout for logging and documenting sessions of a campaign.

This is one of the layouts with a single column, which contains the first-level header, author name, date, and, if defined, tags and categories. Below which list the contents of the post.

| Metadata     | Required? | Type      | Description                            |
|:------------:|:---------:|:---------:|:---------------------------------------|
| `tags`       | :x:       | `array`   | The tags of the post                   |
| `categories` | :x:       | `array`   | The category or categories of the post |

### Spell Layout

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

##### Components

Some spell have material components, arcane focuses or XP costs (*e.g.* [fireball](http://www.d20srd.org/srd/spells/fireball.htm)). If your spell is one such, you need not describe the required components in the body of text of the spell, this layout has it defined in the [front matter], as described above with the `components.material`, `components.focus`, and `components.xp` variables.

All of these are `string` variables that, when defined, will be rendered below the spell description, with an appropriate header.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm