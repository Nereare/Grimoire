# frozen_string_literal: true

Gem::Specification.new do |spec|
  spec.name          = 'nereare_grimoire'
  spec.version       = '1.3.1'
  spec.authors       = ['Igor Padoim']
  spec.email         = ['igorpadoim@gmail.com']

  spec.summary       = 'A jekyll quasi-wiki for RPG-oriented worldbuilding.'
  spec.homepage      = 'https://github.com/Nereare/Grimoire'

  spec.metadata['source_code_uri'] = spec.homepage
  spec.metadata['changelog_uri'] = 'https://github.com/Nereare/Grimoire/blob/master/CHANGELOG.md'

  spec.files         = `git ls-files -z`.split("\x0").select do |f|
    f.match(%r{^((_includes|_layouts|_plugins|_sass|assets|css)/|(LICENSE|README|404)((\.(txt|md|markdown|html)|$)))}i)
  end

  spec.platform = Gem::Platform::RUBY

  spec.add_development_dependency 'html-proofer'
  spec.add_development_dependency 'nokogiri', '>= 1.10.4'

  spec.add_dependency 'jekyll', '~> 3.8.6'
  spec.add_dependency 'jekyll-feed', '~> 0.12.1'
  spec.add_dependency 'jekyll-redirect-from', '~> 0.15.0'
  spec.add_dependency 'jekyll-relative-links', '~> 0.6.0'
  spec.add_dependency 'jekyll-seo-tag', '~> 2.6.1'
  spec.add_dependency 'jekyll-sitemap', '~> 1.3.1'
  spec.add_dependency 'jemoji', '~> 0.11.1'
end