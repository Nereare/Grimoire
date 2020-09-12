# [Grimoire](https://github.com/Nereare/Grimoire) Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed
* Documentation page display names.

## [1.13.10] - `2020-09-12`

### Added
* Age layout.
* Animal layout.
* Armor layout.
* Item layout.
* Plant layout.
* Weapon layout.
* To-do list with future plans to be implemented.

### Fixed
* Miscellaneous dependencies.

### Removed
* GitHub Actions CI.

## [1.7.6] - `2020-02-26`

### Changed
* Version, Copyright, and License texts now customizable.
* Version, Copyright, and License now regular text.

### Fixed
* Liquid syntax for Version, Copyright and License display.

## [1.6.5] - `2020-02-26`

### Added
* Version displaying on header.
* Copyright notice display on header.
* License display on header.

### Changed
* [Hippocratic License](https://firstdonoharm.dev/) to version `2.0`.

### Fixed
* `nokogiri` version to `~> 1.10.8`.

## [1.4.5] - `2019-11-02`

### Changed
* Changed license to [Hippocratic](https://firstdonoharm.dev/).

## [1.4.4] - `2019-10-04`

### Fixed
* Fix some layout issues with `Adventure` and `Settlement` - #3.

## 1.4.3 - `2019-09-26`

### Changed
* Moved documentation from makeshift `_drafts/` folder into proper `docs/` - see [them online](https://nereare.github.io/Grimoire/).

### Fixed
* Moved `css/` folder into the `assets/` folder, for proper inclusion.

## [1.4.2] - `2019-09-26`

### Added
* Installation instructions to [ReadMe file](README.md).

### Changed
* Update Changelog format to [1.0.0](https://keepachangelog.com/en/1.0.0/).
* Stylesheet and font dependencies from Yarn to CDN sources.
* Ignore `script/` folder, since it contains only Travis CI-related scripts.
* Bump [Jekyll](https://jekyllrb.com/) version to `4.0.0`.
* Bump HTML-Proofer version to `3.13.0`.

### Removed
* [Yarn](https://yarnpkg.com/) dependency.
* [jekyll-relative-links](https://github.com/benbalter/jekyll-relative-links) plugin, due to incompatibility with Jekyll `4.0.0`.

## [1.3.2] - `2019-09-06`

### Added
* Release to [RubyGems](https://rubygems.org/) as [`nereare_grimoire`](https://rubygems.org/gems/nereare_grimoire).

### Changed
* Gemfile dependencies to gemspec file.

### Fixed
* Added missing Ruby version to gemspec.

## [1.2.1] - `2019-08-26`

### Added
* Detailed demographics to Settlement layout.
* Update tutorial for detailed demographics.

## [1.0.0] - `2019-08-22`

### Added
* Code of Conduct from [Contributor Covenant v1.4.1](https://www.contributor-covenant.org/).
* [License](LICENSE.md).
* Git metafiles (`.gitignore` and `.gitattributes`).
* GitHub templates:
  - Issues;
  - Feature request;
  - User question;
  - Pull request.
* ReadMe file.
* Changelog file.
* Add [Jekyll](https://jekyllrb.com/) and [Yarn](https://yarnpkg.com/).
* Yarn dependencies:
  - [Libre Baskerville](https://yarnpkg.com/en/package/typeface-libre-baskerville) font, `^0.0.72`;
  - [Material Design Icons](https://yarnpkg.com/en/package/@mdi/font), `^4.1.95`;
  - [Montserrat](https://yarnpkg.com/en/package/typeface-montserrat) font, `^0.0.75`;
  - [Normalize.css](https://yarnpkg.com/en/package/normalize.css), `^8.0.1`;
  - [Noto Sans](https://yarnpkg.com/en/package/typeface-noto-sans) font, `^0.0.72`;
  - [Skeleton](https://yarnpkg.com/en/package/getskeleton), `^2.0.4`;
  - [UnifrakturCook](https://yarnpkg.com/en/package/typeface-unifrakturcook) font, `^0.0.71`.
* Layouts:
  - Adventure;
  - Chapter;
  - Default;
  - Index;
  - Monster;
  - Non-Epic Spell;
  - Post;
  - Settlement.
* Layouts tutorial.
* Custom filters:
  - `AbbrAlignFilter` for getting the abbreviation for alignments;
  - `AbilityModFilter` for appending modifiers to ability scores;
  - `AddSignFilter` for prepending `+` on positive modifiers;
  - `ArticulateFilter` for prepending either *a* or *an* to a word, based on its first word only;
  - `OrdinalFilter` for appenging the ordinal suffix to the number (*e.g.* `th`, `st`);
  - `PluralizeFilter` for appending the singular or plural word, depending on the number given (the code must list both forms of the word);
  - `PrettyNumberFilter` for adding thousands separators.

### Change
* Bump `nokogiri` to `>= 1.10.4`.

[Unreleased]: https://github.com/Nereare/Grimoire/compare/1.13.10...HEAD
[1.13.10]: https://github.com/Nereare/Grimoire/compare/1.7.6...1.13.10
[1.7.6]: https://github.com/Nereare/Grimoire/compare/1.6.5...1.7.6
[1.6.5]: https://github.com/Nereare/Grimoire/compare/1.4.5...1.6.5
[1.4.4]: https://github.com/Nereare/Grimoire/compare/1.4.4...1.4.5
[1.4.4]: https://github.com/Nereare/Grimoire/compare/1.4.2...1.4.4
[1.4.2]: https://github.com/Nereare/Grimoire/compare/1.3.2...1.4.2
[1.3.2]: https://github.com/Nereare/Grimoire/compare/1.2.1...1.3.2
[1.2.1]: https://github.com/Nereare/Grimoire/compare/1.0.0...1.2.1
[1.0.0]: https://github.com/Nereare/Grimoire/releases/tag/1.0.0
