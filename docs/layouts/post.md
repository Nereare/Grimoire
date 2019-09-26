---
title: Post
layout: default

parent: Layouts Guide
nav_order: 4
has_children: true
---

# Post Layout

This is a generic layout, aimed at [Jekyll]'s posts. We suggest using this layout for logging and documenting sessions of a campaign.

This is one of the layouts with a single column, which contains the first-level header, author name, date, and, if defined, tags and categories. Below which list the contents of the post.

| Metadata     | Required? | Type      | Description                            |
|:------------:|:---------:|:---------:|:---------------------------------------|
| `tags`       | :x:       | `array`   | The tags of the post                   |
| `categories` | :x:       | `array`   | The category or categories of the post |

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
