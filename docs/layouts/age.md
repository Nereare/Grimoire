---
title: Age
layout: default

parent: Layouts Guide
nav_order: 7
has_children: true
---

# Age Layout

This layout is aimed at defined periods of time, events that pertained to it and its place in the flow of time.

This layout has a single column, which contains the first-level header, author name, date, age's beginning and end. Below which lies the contents of the chapter, with, when defined, links to previous and next ages.

| Metadata   | Required?          | Type                   | Description                                                              |
|:----------:|:------------------:|:----------------------:|:-------------------------------------------------------------------------|
| `abbr`     | :heavy_check_mark: | `string`               | The abbreviation of the era's name for year notation                     |
| `order`    | :heavy_check_mark: | `integer`              | The order when this age has occured                                      |
| `start`    | :x:                | `integer` or `boolean` | The beginning year of this age, or `false` if unknown                    |
| `end`      | :x:                | `integer` or `boolean` | The last year of this age, or `false` if current age                     |
| `previous` | :x:                | `string` or `boolean`  | The filename (without extension) of the previous age, or `false` if none |
| `next`     | :x:                | `string` or `boolean`  | The filename (without extension) of the next age, or `false` if none     |

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
