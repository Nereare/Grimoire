---
title: Chapter
layout: default

parent: Layouts Guide
nav_order: 2
has_children: true
---

# Chapter Layout

This layout is aimed at written prose and poetry, when these pertain to a book or serial collection of texts. Standalone texts fit better as a post (see below).

This layout has a single column, which contains the first-level header, author name, date, book name and chapter number. Below which lies the contents of the chapter, with, when defined, links to previous and next chapters.

| Metadata   | Required?          | Type                  | Description                                                                           |
|:----------:|:------------------:|:---------------------:|:--------------------------------------------------------------------------------------|
| `book`     | :heavy_check_mark: | `string`              | The name of the book or series to which the text belongs                              |
| `number`   | :heavy_check_mark: | `string` or `integer` | The number of chapter of this text in the above book                                  |
| `previous` | :x:                | `string` or `boolean` | The filename (without extension) of the previous post in the book, or `false` if none |
| `next`     | :x:                | `string` or `boolean` | The filename (without extension) of the next post in the book, or `false` if none     |

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
