---
title: Home
layout: default

nav_order: 1
---

# Welcome to Grimoire!

<p class="fs-6">This is a <a href="//jekyllrb.com">Jekyll</a> theme aimed at worldbuilders who want to document their creation with the help of technology, but don't want to host away all this information.</p>

[View on GitHub](https://github.com/Nereare/Grimoire){: .btn .btn-purple .mr-2 .fs-6 }
[RubyGems.org](https://rubygems.org/gems/nereare_grimoire){: .btn .fs-6 }

***

## Getting Started

[Grimoire] is a theme for [Jekyll] version `4.0.0` and up, so it depends on [Ruby] and [RubyGems], managed through [Bundler]. These last dependencies must be installed in order for this theme to be usable.

## Installing

Add the gem to your `Gemfile`:

```ruby
gem 'nereare_grimoire'
```

Once all dependencies are installed, follow [Jekyll]'s tutorial on how to create a new blog. On the `_config.yml` file, set:

```yaml
# Required Block
title: Creation Name
email: your@email.here
description: Description of the creation
collect_short: true
# Optional Information
version:
  text: Version
  version: 3.14.1592-6535
copyright:
  text: &copy;
  year: 2019-2020
  name: Your Name
license:
  text: Distributed under the
  name: Some License
  link: https://some.license.here/

# Do-not-change Blocks
theme: nereare_grimoire
markdown: kramdown
plugins:
  - jekyll-feed
  - jekyll-redirect-from
  - jekyll-seo-tag
  - jekyll-sitemap
  - jemoji

# Collections
collections:
  adventures:
    output: true
    sort_by: title
  ages:
    output: true
    sort_by: title
  animals:
    output: true
    sort_by: title
  chapters:
    output: true
    sort_by: chapter.book
  items:
    output: true
    sort_by: title
  monsters:
    output: true
    sort_by: title
  plants:
    output: true
    sort_by: title
  posts:
    output: true
    sort_by: title
  settlements:
    output: true
    sort_by: title
  spells:
    output: true
    sort_by: title

exclude:
  - Gemfile
  - Gemfile.lock
  - vendor/bundle/
  - vendor/cache/
  - vendor/gems/
  - vendor/ruby/
  - CHANGELOG.md
  - CODE-OF-CONDUCT.md
  - CONTRIBUTING.md
  - LICENSE.md
  - OGL.md
  - README.md
```

The first block (the `Required Block`) you must fill with appropriate data. Then there are some optional metadata you may fill or ignore altogether.

The remainder of the configuration file is settings required by the theme, such as collections' configurations and excludes.

As of now, this theme supports the following page types, which you can read further on their [respective documentation pages](layouts):

- Adventure layout;
- Age layout;
- Animal layout
- Chapter layout;
- Item layout;
- Monster layout;
- Plant layout;
- Post layout;
- Settlement layout; and
- Spell layout.

We also recommend you read first the [Introduction to Layouts](introduction) guide.

## Collections Showing

The index page has the capability to show the collections' contents either in-page (when set to `true`) or as standalone pages for each collection (when set to `false`).

## Restriction

This project uses custom filters, which is not supported by GitHub pages, so sorry, but it cannot properly work under this circunstance. :cry:

[Grimoire]: https://github.com/Nereare/Grimoire
[Jekyll]: https://jekyllrb.com/
[Ruby]: https://www.ruby-lang.org/
[RubyGems]: https://rubygems.org/
[Bundler]: https://bundler.io/
