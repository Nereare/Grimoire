---
title: Settlement
layout: default

parent: Layouts Guide
nav_order: 5
has_children: true
---

# Settlement Layouts

This layout is aimed at documenting cities, towns, metropoleis and other settlements, as well as their structures of power, shops and houses.

This layout has two columns:

1. The left column contains the first-level header, author name, date, contents and, below these, a list of both shops and/or houses, where available.
2. The right column contains the settlement metadata, which, as the shops and houses, are defined in the [front matter].

## Settlement Metadata

These are the metadata shown on the right column of the layout.

| Metadata          | Required?          | Type                 | Description                                                                      |
|:-----------------:|:------------------:|:--------------------:|:---------------------------------------------------------------------------------|
| `name`            | :heavy_check_mark: | `string`             | The name of the settlement |
| `type`            | :heavy_check_mark: | `string`             | The type of settlement |
| `size`            | :heavy_check_mark: | `string`             | The size (area) of the settlement, with unit |
| `demographics`    | :heavy_check_mark: | `array` of `object`s | An array of objects, each of which defines a fraction of the population |
| `race.race`       | :heavy_check_mark: | `string`             | The race of this fraction |
| `race.percent`    | :heavy_check_mark: | `integer`            | How much of the population is this fractions (without `%`) |
| `population`      | :heavy_check_mark: | `integer`            | Total number of people on this settlement |
| `gp-limit`        | :x:                | `integer`            | The maximum price any single item may cost |
| `wealth`          | :x:                | `integer`            | The total wealth of the settlement |
| `centres`         | :x:                | `array` of `object`s | An array of objects, each of which defines a single center of power. |
| `centre.type`     | :heavy_check_mark: | `string`             | The type of power structure |
| `centre.name`     | :heavy_check_mark: | `string`             | The name of the power structure |
| `centre.align`    | :heavy_check_mark: | `string`             | The alignment of the power structure |
| `authorities`     | :x:                | `array` of `object`s | An array of objects, each of which defines one authority figure of the settlement |
| `authority.class` | :heavy_check_mark: | `string`             | The class of the authority, or the 5E template |
| `authority.level` | :x:                | `integer`            | The level of the authority |
| `authority.title` | :heavy_check_mark: | `string`             | The title the authority holds |
| `authority.name`  | :heavy_check_mark: | `string`             | The name of the authority |

## Shops Metadata

This variable is an `array` of `object`s, each of which is explained below.

Defining any shops is optional, but should you define them, most variables are required, see below.

| Metadata          | Required?          | Type                   | Description                                                                      |
|:-----------------:|:------------------:|:----------------------:|:---------------------------------------------------------------------------------|
| `type`            | :heavy_check_mark: | `string`               | The type of shop                                                                 |
| `name`            | :heavy_check_mark: | `string`               | The name of the shop                                                             |
| `owner`           | :x:                | `object`               | An object defining the owner of the shop                                         |
| `owner.name`      | :heavy_check_mark: | `string`               | The name of the owner                                                            |
| `owner.gender`    | :heavy_check_mark: | `string`               | The gender of the owner                                                          |
| `owner.race`      | :heavy_check_mark: | `string`               | The race of the owner                                                            |
| `owner.class`     | :heavy_check_mark: | `string`               | The class of the owner                                                           |
| `owner.level`     | :heavy_check_mark: | `integer`              | The level of the owner                                                           |
| `prices`          | :heavy_check_mark: | `object`               | An object defining the price rates of the shop                                   |
| `prices.sell`     | :heavy_check_mark: | `integer` or `boolean` | The price percentage (without the `%`) of selled goods, or `false` if don't sell |
| `prices.buy`      | :heavy_check_mark: | `integer` or `boolean` | The price percentage (without the `%`) of buyed goods, of `false` if don't buy   |
| `location`        | :heavy_check_mark: | `string`               | The location of the shop                                                         |
| `desc`            | :heavy_check_mark: | `string`               | The description of the shop                                                      |
| `goods`           | :x:                | `object`               | An object defining the type and list of selled goods                             |
| `goods.name`      | :heavy_check_mark: | `string`               | The name of the selled goods (*e.g.* `Potions` or `Weapons`)                     |
| `goods.list`      | :heavy_check_mark: | `array` of `object`s   | As array of objects, each of which is a single selling item                      |
| `goods.item.name` | :heavy_check_mark: | `string`               | The name of the item                                                             |
| `goods.item.cost` | :heavy_check_mark: | `string`               | The price of the item (with currency, *e.g.* `8 cp`)                             |

## Houses Metadata

This variable is also an `array` of `object`s, each of which is explained below.

Defining any houses is optional, but should you define them, most variables are required, see below.

| Metadata        | Required?          | Type                 | Description                                                                  |
|:---------------:|:------------------:|:--------------------:|:-----------------------------------------------------------------------------|
| `type`          | :heavy_check_mark: | `string`             | The type of house (*e.g.* `Tiny Cottage`)                                    |
| `name`          | :x:                | `string`             | If appliable, the unique name of the house                                   |
| `location`      | :heavy_check_mark: | `string`             | The location of the house within the settlement                              |
| `desc`          | :heavy_check_mark: | `string`             | A description of the house                                                   |
| `people`        | :heavy_check_mark: | `array` of `object`s | An array of objects, each of which defines one person who lives in the house |
| `person.name`   | :heavy_check_mark: | `string`             | The name of the inhabitant                                                   |
| `person.gender` | :heavy_check_mark: | `string`             | The gender of the inhabitant                                                 |
| `person.race`   | :heavy_check_mark: | `string`             | The race of the inhabitant                                                   |
| `person.class`  | :heavy_check_mark: | `string`             | The class of the inhabitant                                                  |
| `person.level`  | :heavy_check_mark: | `integer`            | The level of the inhabitant                                                  |
| `person.owner`  | :x:                | `boolean`            | Whether or not this inhabitant is the owner of the house                     |
| `items`         | :x:                | `array` of `object`s | An array of objects, each of which defines one item of note within the house |
| `item.name`     | :heavy_check_mark: | `string`             | The name of the object or type of object                                     |
| `item.desc`     | :heavy_check_mark: | `string`             | The description of the object or type of object                              |

## Demographics Metadata

This variable is also an `array` of `object`s, with a settled pattern.

Detailing the demographics of the settlement is optional, but should you want to detail it further, most of the variables are required, see below.

| Metadata                     | Required?          | Type      | Description |
|:----------------------------:|:------------------:|:---------:|:------------|
| `title`                      | :heavy_check_mark: | `string`  | Name of the class of demographic |
| `desc`                       | :heavy_check_mark: | `array`   | An array of objects, each detailing the subclass of demographics |

See the example for how to format.

### Demographic's Subclass Objects

Each class of demographic can contain any number of subclasses. Each subclass contains a title and a quantity, both of which are required.

| Metadata                     | Required?          | Type      | Description |
|:----------------------------:|:------------------:|:---------:|:------------|
| `title`                      | :heavy_check_mark: | `string`  | Name of the subclass of demographic |
| `qtt`                        | :heavy_check_mark: | `integer` | The number of members of this subclass of demographic |

## Buildings Metadata

The quantity of buildings is now also customizable. Under the `buildings` variable, which is optional, one may define any number of building count.

| Metadata                     | Required?          | Type      | Description |
|:----------------------------:|:------------------:|:---------:|:------------|
| `title`                      | :heavy_check_mark: | `string`  | Name of the class of building |
| `qtt`                        | :heavy_check_mark: | `integer` | The number of buildings of this class |

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
