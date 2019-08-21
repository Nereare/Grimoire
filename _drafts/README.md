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

We ask that each file be named according to Jekyll [convention to post names](https://jekyllrb.com/docs/posts/), with its [date](http://xkcd.com/1179/) of writing or finishing, as you see fit, and its title without special characters and accents, and all whitespaces replaced by hyphens (`-`), in the form: `YYYY-MM-DD-title-without-spaces.md`

### Common Front Matter

All files must have [front matter] defined in its top. Below we will discuss specifics for each collection, but all of them has some common elements:

| Variable | Description                                                      |
|:--------:|:-----------------------------------------------------------------|
| `title`  | The title with all possible UTF-8 characters                     |
| `author` | Your name                                                        |
| `date`   | The same date as in the filename, following [ISO 8601]'s format  |
| `layout` | One of the layouts available - please don't alter the template's |

All layouts will output, under the first-level header (`h1`), both the author name and the date.

## Individualities

Each layout has specialized [front matter], which is used by the layout on display. Here we discuss each of them.

### Adventure Layout

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

[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
