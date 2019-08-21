# [Grimoire](https://github.com/Nereare/Grimoire) Change Log

This is the change log to Grimoire. For further info on this project, see the [ReadMe file](README.md).

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

Principles of a change log, excerpted from [Keep a Changelog](http://keepachangelog.com/):

* It’s made for humans, not machines, so legibility is crucial.
* Easy to link to any section (hence Markdown over plain text).
* One sub-section per version.
* List releases in reverse-chronological order (newest on top).
* Write all dates in `YYYY-MM-DD` format. (Example: `2012-06-02` for `June 2nd, 2012`.) It’s international, [sensible](http://xkcd.com/1179/), and language-independent.
* Explicitly mention whether the project follows [Semantic Versioning](http://semver.org/).
* Each version should:
  * `List` its release date in the above format.
  * `Group` changes to describe their impact on the project, as follows:
    * `Added` for new features.
    * `Changed` for changes in existing functionality.
    * `Deprecated` for once-stable features removed in upcoming releases.
    * `Removed` for deprecated features removed in this release.
    * `Fixed` for any bug fixes.
    * `Security` to invite users to upgrade in case of vulnerabilities.

## [Unreleased]

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
  - Default;
  - Monster;
  - Post;
  - Non-Epic Spell.

### Change
* Bump `nokogiri` to `>= 1.10.4`.
