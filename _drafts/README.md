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

### Chapter Layout

This layout is aimed at written prose and poetry, when these pertain to a book or serial collection of texts. Standalone texts fit better as a post (see below).

This layout has a single column, which contains the first-level header, author name, date, book name and chapter number. Below which lies the contents of the chapter, with, when defined, links to previous and next chapters.

| Metadata   | Required?          | Type                  | Description                                                                           |
|:----------:|:------------------:|:---------------------:|:--------------------------------------------------------------------------------------|
| `book`     | :heavy_check_mark: | `string`              | The name of the book or series to which the text belongs                              |
| `number`   | :heavy_check_mark: | `string` or `integer` | The number of chapter of this text in the above book                                  |
| `previous` | :x:                | `string` or `boolean` | The filename (without extension) of the previous post in the book, or `false` if none |
| `next`     | :x:                | `string` or `boolean` | The filename (without extension) of the next post in the book, or `false` if none     |

### Monster Layout

This layout is aimed at documenting monsters and creatures of any kind. This may somewhat serve even as a PC/NPC sheet, although it is not its main intent.

This layout has two columns:

1. The left one contains the fist-level header, author name and date. Under which sits the description of the creature, its habits and tactics - everything but its game statistics.
2. The right column contains its game statistics, which must be defined in the [front matter].

| Metadata           | Required?          | Type                 | Description                                                                          |
|:------------------:|:------------------:|:--------------------:|:-------------------------------------------------------------------------------------|
| `name`             | :heavy_check_mark: | `string`             | Name of the creature                                                                 |
| `size`             | :heavy_check_mark: | `string`             | The size of the creature (*e.g.* Huge, Medium)                                       |
| `type`             | :heavy_check_mark: | `string`             | The type of creature (*e.g.* Aberration, Dragon)                                     |
| `align`            | :heavy_check_mark: | `string`             | The align, or lack thereof, of the creature                                          |
| `ac`               | :heavy_check_mark: | `object`             | An object containing the Armor Class elements                                        |
| `ac.base`          | :heavy_check_mark: | `integer`            | The base AC value                                                                    |
| `ac.desc`          | :x:                | `string`             | The description of the base AC, when appliable (*e.g.* `+2 natural`)                 |
| `ac.touch`         | :heavy_check_mark: | `integer`            | The touch AC value                                                                   |
| `ac.flat`          | :heavy_check_mark: | `integer`            | The flat-footed AC value                                                             |
| `hp`               | :heavy_check_mark: | `object`             | An object containing the health elements of the creature                             |
| `hp.hp`            | :heavy_check_mark: | `integer`            | The maximum hit points of the creature                                               |
| `hp.hd`            | :heavy_check_mark: | `string`             | The hit dice of the creature and any bonus (*e.g.* `10d8 + 15`)                      |
| `speed`            | :heavy_check_mark: | `string`             | The speed of the creature (*e.g.* `30ft`)                                            |
| `initiative`       | :heavy_check_mark: | `integer`            | The initiative bonus of the creature                                                 |
| `space`            | :heavy_check_mark: | `string`             | The space border occupied by the creature                                            |
| `reach`            | :heavy_check_mark: | `string`             | The reach of the creature                                                            |
| `saves`            | :heavy_check_mark: | `object`             | An object containing the saving throw bonuses of the creature                        |
| `saves.fort`       | :heavy_check_mark: | `integer`            | The Fortitude bonus of the creature                                                  |
| `saves.ref`        | :heavy_check_mark: | `integer`            | The Reflex bonus of the creature                                                     |
| `saves.will`       | :heavy_check_mark: | `integer`            | The Will bonus of the creature                                                       |
| `abilities`        | :heavy_check_mark: | `object`             | An object containing the abilities of the creature                                   |
| `abilities.str`    | :heavy_check_mark: | `integer`            | The Strength of the creature                                                         |
| `abilities.dex`    | :heavy_check_mark: | `integer`            | The Dexterity of the creature                                                        |
| `abilities.con`    | :heavy_check_mark: | `integer`            | The Constitution of the creature                                                     |
| `abilities.int`    | :heavy_check_mark: | `integer`            | The Intelligence of the creature                                                     |
| `abilities.wis`    | :heavy_check_mark: | `integer`            | The Wisdom of the creature                                                           |
| `abilities.cha`    | :heavy_check_mark: | `integer`            | The Charisma of the creature                                                         |
| `skills`           | :x:                | `string`             | A string *list* of all skills of the creature and their bonuses                      |
| `feats`            | :x:                | `strint`             | A string *list* of all feats of the creature                                         |
| `cr`               | :heavy_check_mark: | `integer`            | The Challenge Rating of the creature                                                 |
| `treasure`         | :heavy_check_mark: | `string`             | The treasure the creature possess, or the lack thereof                               |
| `advancement`      | :heavy_check_mark: | `string`             | Any advancements you may apply to the creature                                       |
| `lvl_adj`          | :heavy_check_mark: | `string`             | Any level adjustments for the creature                                               |
| `env`              | :heavy_check_mark: | `string`             | The environment of the creature                                                      |
| `org`              | :heavy_check_mark: | `string`             | The type of organization of the creature (*e.g.* `Solitary`)                         |
| `qualities`        | :x:                | `string`             | A string *list* of the special qualities of the creature                             |
| `sp_attacks`       | :x:                | `string`             | A string *list* of the special attacks of the creature                               |
| `attacks`          | :heavy_check_mark: | `array` of `object`s | An array of objects, each element being one attack, at least one element is required |
| `attacks.name`     | :heavy_check_mark: | `string`             | The name of the attack                                                               |
| `attacks.desc`     | :heavy_check_mark: | `string`             | The bonus to this attack, the damage and damage type                                 |
| `possessions`      | :x:                | `array` of `object`s | An array of objects, each element being a different item                             |
| `possessions.name` | :heavy_check_mark: | `string`             | The name of the item                                                                 |
| `possessions.desc` | :heavy_check_mark: | `string`             | A short description of the item, and any bonus or ability it may grant the creature  |

##### Data with Units

If the metadata variable you are setting would have a spacial unit (*e.g.* `ft`, `mi`, `m`, `km`), you must give it into the variable, which will certainly be a `string`. Sadly, D&amp;D works under the archaic imperial system of units, should you want to convert everything under this layout, you may - and would make its owner very proud and happy in the process.

Variables pertaining to hit points need not be given `hp` after them, the layout deal with them.

##### Abilities

Each ability variable must be only the base value, the raw score. The layout calculates and appends the modifiers on its own.

##### String Lists

Some of the variables are `string`s, but they contain a list. What this means is that, eventhough it is a list, the layout does not iterate through it, the list is just outputted as a string. So, write a simple list, not an array.

##### Arrays of Objects

These elements contain an array of objects, which are iterated through the layout.

### Post Layout

This is a generic layout, aimed at [Jekyll]'s posts. We suggest using this layout for logging and documenting sessions of a campaign.

This is one of the layouts with a single column, which contains the first-level header, author name, date, and, if defined, tags and categories. Below which list the contents of the post.

| Metadata     | Required? | Type      | Description                            |
|:------------:|:---------:|:---------:|:---------------------------------------|
| `tags`       | :x:       | `array`   | The tags of the post                   |
| `categories` | :x:       | `array`   | The category or categories of the post |

### Settlement Layouts

This layout is aimed at documenting cities, towns, metropoleis and other settlements, as well as their structures of power, shops and houses.

This layout has two columns:

1. The left column contains the first-level header, author name, date, contents and, below these, a list of both shops and/or houses, where available.
2. The right column contains the settlement metadata, which, as the shops and houses, are defined in the [front matter].

#### Settlement Metadata

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

#### Shops Metadata

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

#### Houses Metadata

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

#### Demographics Metadata

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
