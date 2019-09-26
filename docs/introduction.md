---
title: Introduction to Layouts
layout: default

nav_order: 2
---

# Writing a Post

So, I see you feel ready to write a post! That's amazing! :smile:

Please do note that this template has some special [collections](https://jekyllrb.com/docs/collections/), aimed at RPG-oriented resources. Each collection has a **template** model, which we strongly suggest you copy and fill with your creation.

After you created what you want, you must move your creation to the adequate folder.

| Collection  | Sub-folder     | Layout       | Description                                                                              |
|:-----------:|:--------------:|:------------:|:-----------------------------------------------------------------------------------------|
| Adventures  | `_adventures`  | `adventure`  | Each individual adventure, with all its data, encounters and steps                       |
| Chapters    | `_chapters`    | `chapter`    | Texts, prose or otherwise, in a series or book                                           |
| Monsters    | `_monsters`    | `monster`    | Individual monsters, NPCs, PCs or other creatures                                        |
| Posts       | `_posts`       | `post`       | Generic post format with few metadata                                                    |
| Settlements | `_settlements` | `settlement` | Cities, towns and other settlements, as well as their ruling structure, shops and houses |
| Spells      | `_spells`      | `spell`      | Non-epic spells of any class and nature                                                  |

## Common Aspects

### File Names

We ask that each file be named according to [Jekyll]'s [convention to post names](https://jekyllrb.com/docs/posts/), with its [date](http://xkcd.com/1179/) of writing or finishing, as you see fit, and its title without special characters and accents, and all whitespaces replaced by hyphens (`-`), in the form: `YYYY-MM-DD-title-without-spaces.md`

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

Each layout has specialized [front matter], which is used by the layout on display. We discuss each of them further on the [Layouts](layouts) guide.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
