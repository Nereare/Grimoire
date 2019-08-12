# Repository Template

Hello and welcome!

This repo's template features the minimal barebones needed for a general [git]() project to feature:

* Git attributes file;
* Git ignore file;
* [Changelog](https://keepachangelog.com/en/1.0.0/);
* [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/version/1/4/code-of-conduct.html);
* Contributing guidelines;
* [MIT License](https://opensource.org/licenses/MIT);
* Read Me file;
* GitHub's issue and feature request templates;
* GitHub Bots' configuration.

## Bots

This template assumes you have installed and given appropriate access to these Bots:

* [Sentiment Bot](https://probot.github.io/apps/sentiment-bot/);
* [todo](https://probot.github.io/apps/todo/) bot; and
* [Welcome](https://probot.github.io/apps/welcome/) bot.

None of these, of course, are required. And, if none of them is used, their [configuration file](.github/config.yml) may be removed.

### Bot Configuration

All messages' or comments' texts are based upon [this gist](https://gist.github.com/Nereare/b976e4d9d9832f4a3541417777ad85aa). Feel free to fork it.

#### Sentiment Bot

See [its page](https://probot.github.io/apps/sentiment-bot/) for further configuration. This template sets two variables: `sentimentBotToxicityThreshold` and `sentimentBotReplyComment`. You may customize both, but stick to the latter.

#### todo bot

See [its page](https://probot.github.io/apps/todo/) for further configuration. This template sets two variables: `autoAssign` and `exclude`, which sets the user resposible for the push to be the assignee of the issue, and ignores the `.gitattributes` file from issue opening. We suggest keeping this way.

#### Welcome bot

This bot are actually three bots into one. See the central [page](https://probot.github.io/apps/welcome/) for further configuration. There are three variables, each being the message posted by the bot: `newIssueWelcomeComment`, `newPRWelcomeComment`, and `firstPRMergeComment`. You may customize these messages if you wish.

## To-Do's

In order to make this repository your own, follow these steps:

- [ ] Choose a license:
  - [ ] If it is not the MIT: change the [license file](LICENSE.md) contents;
- [ ] Customize [bot configuration](.github/config.yml) if you wish;
- [ ] Change the names:
  - [ ] Search folder for `{{PKG_NAME}}` and replace all instaces by the repository name;
  - [ ] Search folder for `{{PKG_REPO}}` and replace all instaces by the repository's author and name as the format `author/package-name` (*e.g.* `Nereare/pretty-regret`); and
  - [ ] Search folder for `{{PKG_YEAR}}` and replace all instaces by the repository copyright years with four digits (*e.g.* `2019` or `2012-2018`);
- [ ] On the [Read Me file](README.md), delete the line referring to this tutorial.

Now you are all set! :tada:

<!--
TODO Delete the template instructions
BODY Once you have set up the repository from the template, delete the template's [guide file](DELETE_ME.md).
-->
