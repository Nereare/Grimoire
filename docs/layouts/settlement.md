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
| `gp-limit`        | :heavy_check_mark: | `integer`            | The maximum price any single item may cost |
| `wealth`          | :heavy_check_mark: | `integer`            | The total wealth of the settlement |
| `centres`         | :x:                | `array` of `object`s | An array of objects, each of which defines a single center of power. |
| `centre.type`     | :heavy_check_mark: | `string`             | The type of power structure |
| `centre.name`     | :heavy_check_mark: | `string`             | The name of the power structure |
| `centre.align`    | :heavy_check_mark: | `string`             | The alignment of the power structure |
| `authorities`     | :x:                | `array` of `object`s | An array of objects, each of which defines one authority figure of the settlement |
| `authority.class` | :heavy_check_mark: | `string`             | The class of the authority |
| `authority.level` | :heavy_check_mark: | `integer`            | The level of the authority |
| `authority.title` | :heavy_check_mark: | `string`             | The title the authority holds |
| `authority.name`  | :heavy_check_mark: | `string`             | The name of the authority |

## Shops Metadata

This variable is an `array` of `object`s, each of which is explained below.

Defining any shops is optional, but should you define them, most variables are required, see below.

| Metadata          | Required?          | Type                   | Description                                                                      |
|:-----------------:|:------------------:|:----------------------:|:---------------------------------------------------------------------------------|
| `type`            | :heavy_check_mark: | `string`               | The type of shop                                                                 |
| `name`            | :heavy_check_mark: | `string`               | The name of the shop                                                             |
| `owner`           | :heavy_check_mark: | `object`               | An object defining the owner of the shop                                         |
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

This variable is also an `array` of `object`s, each of which is explained below.

Detailing the demographics of the settlement is optional, but should you want to detail it further, most of the variables are required, see below.

| Metadata                     | Required?          | Type      | Description                                                  |
|:----------------------------:|:------------------:|:---------:|:-------------------------------------------------------------|
| `overview`                   | :heavy_check_mark: | `object`  | An object defining the subtotal people of the settlement     |
| `overview.nobles`            | :heavy_check_mark: | `integer` | Number of nobles of the settlement                           |
| `overview.officers`          | :heavy_check_mark: | `integer` | Number of officers of the settlement                         |
| `overview.clergy`            | :heavy_check_mark: | `integer` | Number of clergy of the settlement                           |
| `overview.freeholders`       | :heavy_check_mark: | `integer` | Number of freeholders of the settlement                      |
| `overview.citizens`          | :heavy_check_mark: | `integer` | Number of citizens of the settlement                         |
| `overview.hirelings`         | :heavy_check_mark: | `integer` | Number of hirelings of the settlement                        |
| `ruling-house`               | :heavy_check_mark: | `object`  | An object defining the ruling house of the settlement        |
| `ruling-house.nobles`        | :heavy_check_mark: | `integer` | Number of nobles of the ruling house                         |
| `ruling-house.relatives`     | :heavy_check_mark: | `integer` | Number of relatives of the ruling house                      |
| `ruling-house.servants`      | :heavy_check_mark: | `integer` | Number of servants of the ruling house                       |
| `ruling-house.guards`        | :heavy_check_mark: | `integer` | Number of guards of the ruling house                         |
| `ruling-house.serjaants`     | :heavy_check_mark: | `integer` | Number of serjaants of the ruling house                      |
| `other-houses`               | :heavy_check_mark: | `object`  | An object defining totals of other houses of the settlement  |
| `other-houses.houses`        | :heavy_check_mark: | `integer` | Number of other noble houses                                 |
| `other-houses.population`    | :heavy_check_mark: | `integer` | Total population on the other noble houses                   |
| `officers`                   | :heavy_check_mark: | `object`  | An object defining the officer force of the settlement       |
| `officers.reeves`            | :heavy_check_mark: | `integer` | Number of reeves of the settlement                           |
| `officers.messors`           | :heavy_check_mark: | `integer` | Number of messors of the settlement                          |
| `officers.woodwards`         | :heavy_check_mark: | `integer` | Number of woodwards of the settlement                        |
| `officers.constables`        | :heavy_check_mark: | `integer` | Number of constables of the settlement                       |
| `officers.guards`            | :heavy_check_mark: | `integer` | Number of guards of the settlement                           |
| `clergy`                     | :heavy_check_mark: | `object`  | An object defining the clerymen of the settlement            |
| `clergy.clerics`             | :heavy_check_mark: | `integer` | Number of clerics of the settlement                          |
| `clergy.priests`             | :heavy_check_mark: | `integer` | Number of (fully-vested) priests of the settlement           |
| `freeholders`                | :heavy_check_mark: | `object`  | An object defining each of the freeholders on the settlement |
| `freeholders.adventures`     | :x:                | `integer` | Number of adventures on the settlement                       |
| `freeholders.apothecaries`   | :x:                | `integer` | Number of apothecaries on the settlement                     |
| `freeholders.armourers`      | :x:                | `integer` | Number of armourers on the settlement                        |
| `freeholders.artists`        | :x:                | `integer` | Number of artists on the settlement                          |
| `freeholders.butchers`       | :x:                | `integer` | Number of butchers on the settlement                         |
| `freeholders.chandlers`      | :x:                | `integer` | Number of chandlers on the settlement                        |
| `freeholders.charcoalers`    | :x:                | `integer` | Number of charcoalers on the settlement                      |
| `freeholders.cobblers`       | :x:                | `integer` | Number of cobblers on the settlement                         |
| `freeholders.entertainers`   | :x:                | `integer` | Number of entertainers on the settlement                     |
| `freeholders.foresters`      | :x:                | `integer` | Number of foresters on the settlement                        |
| `freeholders.furriers`       | :x:                | `integer` | Number of furriers on the settlement                         |
| `freeholders.glassworkers`   | :x:                | `integer` | Number of glassworkers on the settlement                     |
| `freeholders.innkeepers`     | :x:                | `integer` | Number of innkeepers on the settlement                       |
| `freeholders.jewelers`       | :x:                | `integer` | Number of jewelers on the settlement                         |
| `freeholders.litigants`      | :x:                | `integer` | Number of litigants on the settlement                        |
| `freeholders.locksmiths`     | :x:                | `integer` | Number of locksmiths on the settlement                       |
| `freeholders.masons`         | :x:                | `integer` | Number of masons on the settlement                           |
| `freeholders.metalsmiths`    | :x:                | `integer` | Number of metalsmiths on the settlement                      |
| `freeholders.bakers`         | :x:                | `integer` | Number of bakers on the settlement                           |
| `freeholders.ostlers`        | :x:                | `integer` | Number of ostlers on the settlement                          |
| `freeholders.outfitters`     | :x:                | `integer` | Number of outfitters on the settlement                       |
| `freeholders.physicians`     | :x:                | `integer` | Number of physicians on the settlement                       |
| `freeholders.potters`        | :x:                | `integer` | Number of potters on the settlement                          |
| `freeholders.roofers`        | :x:                | `integer` | Number of roofers on the settlement                          |
| `freeholders.ropemakers`     | :x:                | `integer` | Number of ropemakers on the settlement                       |
| `freeholders.sages`          | :x:                | `integer` | Number of sages on the settlement                            |
| `freeholders.salters`        | :x:                | `integer` | Number of salters on the settlement                          |
| `freeholders.scribes`        | :x:                | `integer` | Number of scribes on the settlement                          |
| `freeholders.shipwrights`    | :x:                | `integer` | Number of shipwrights on the settlement                      |
| `freeholders.tailors`        | :x:                | `integer` | Number of tailors on the settlement                          |
| `freeholders.tanners`        | :x:                | `integer` | Number of tanners on the settlement                          |
| `freeholders.taverners`      | :x:                | `integer` | Number of taverners on the settlement                        |
| `freeholders.teamsters`      | :x:                | `integer` | Number of teamsters on the settlement                        |
| `freeholders.timberwrights`  | :x:                | `integer` | Number of timberwrights on the settlement                    |
| `freeholders.tinkers`        | :x:                | `integer` | Number of tinkers on the settlement                          |
| `freeholders.vintners`       | :x:                | `integer` | Number of vintners on the settlement                         |
| `freeholders.weaponcrafters` | :x:                | `integer` | Number of weaponcrafters on the settlement                   |
| `freeholders.weavers`        | :x:                | `integer` | Number of weavers on the settlement                          |
| `freeholders.woodcrafters`   | :x:                | `integer` | Number of woodcrafters on the settlement                     |
| `freeholders.yeomen`         | :x:                | `integer` | Number of yeomen on the settlement                           |
| `buildings`                  | :heavy_check_mark: | `object`  | An object defining the number of each type of building       |
| `buildings.mansions`         | :heavy_check_mark: | `integer` | Number of mansions on the settlement                         |
| `buildings.churches`         | :heavy_check_mark: | `integer` | Number of churches on the settlement                         |
| `buildings.businesses`       | :heavy_check_mark: | `integer` | Number of business buildings on the settlement               |
| `buildings.municipal`        | :heavy_check_mark: | `integer` | Number of municipal buildings on the settlement              |
| `buildings.homes`            | :heavy_check_mark: | `integer` | Number of homes on the settlement                            |
| `buildings.total`            | :heavy_check_mark: | `integer` | Total number of buildings on the settlement                  |

[Jekyll]: https://jekyllrb.com/
[front matter]: https://jekyllrb.com/docs/front-matter/
[ISO 8601]: https://www.iso.org/iso-8601-date-and-time-format.html
[SRD]: http://www.d20srd.org/index.htm
