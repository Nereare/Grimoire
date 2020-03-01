---
title: Plant
layout: default

parent: Layouts Guide
nav_order: 9
has_children: true
---

# Plants Layout

This layout is aimed at plants and fungi from the world.

This layout has a single column, which contains the first-level header, author name, date, species scientific name, linnaean classification of the plant, metadata and the body of text of the species description.

| Metadata          | Required?          | Type                 | Description                                                                |
|:-----------------:|:------------------:|:--------------------:|:---------------------------------------------------------------------------|
| `species`         | :heavy_check_mark: | `string`             | The scientific name of the species                                         |
| `linnaean`        | :x:                | `array`              | A list of strings, each the name of one of the linnaean groups<sup>1</sup> |
| `feeding`         | :x:                | `string` or `object` | The type of trophism of the species                                        |
| `feeding.type`    | :x:                | `string`             | The major group of trophism (`Autotroph` or `Heterotroph`)                 |
| `feeding.subtype` | :x:                | `string`             | The pattern of feeding (*e.g.* fotosynthesizer, herbivore)                 |
| `sizes`           | :x:                | `string` or `object` | The size of the species, either a class of size or the range of sizes      |
| `sizes.type`      | :heavy_check_mark: | `string`             | The dimension of size (*e.g.* length, height, wingspan)                    |
| `sizes.unit`      | :heavy_check_mark: | `string`             | The unit of measure (*e.g.* m, ft, mm)                                     |
| `sizes.min`       | :heavy_check_mark: | `integer`            | The smallest size of an adult specimen                                     |
| `sizes.max`       | :heavy_check_mark: | `integer`            | The largest size of an adult specimen                                      |
| `habitat`         | :x:                | `string` or `object` | The place where this species is usually found                              |
| `habitat.biome`   | :heavy_check_mark: | `string`             | The kind of environment the species calls home                             |
| `habitat.plane`   | :x:                | `string`             | The plane of existance from where the species comes                        |
| `iucn`            | :x:                | `string` from list   | The two-letter code of the conservation state of this species<sup>2</sup>  |
| `domestic`        | :x:                | `boolean`            | Whether or not this species is domesticated                                |
| `fruit`           | :x:                | `string`             | The type of fruit or produce the plant generates, if any                   |
| `seed`            | :x:                | `string`             | The type of seed, spore or reproducing method of this species              |
| `note`            | :x:                | `string`             | A short comment on the plant not under the above categories                |

1. See the [taxonomic rank][wiki] for the Linnaean groups.
2. See the [IUCN Red List][iucn] categories, we use the 2001 version.

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
[wiki]: https://en.wikipedia.org/wiki/Taxonomic_rank
[iucn]: https://en.wikipedia.org/wiki/IUCN_Red_List#Categories
