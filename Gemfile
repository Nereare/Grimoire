source "https://rubygems.org"

gem "jekyll", "~> 3.8.6"
gem "html-proofer"
gem "nokogiri", ">= 1.10.4"

group :jekyll_plugins do
  gem "jekyll-feed"
  gem "jekyll-redirect-from"
  gem "jekyll-relative-links"
  gem "jekyll-seo-tag"
  gem "jekyll-sitemap"
  gem "jemoji"
end

# Windows does not include zoneinfo files, so bundle the tzinfo-data gem
# and associated library.
install_if -> { RUBY_PLATFORM =~ %r!mingw|mswin|java! } do
  gem "tzinfo", "~> 1.2"
  gem "tzinfo-data"
end

# Performance-booster for watching directories on Windows
gem "wdm", "~> 0.1.0", :install_if => Gem.win_platform?
