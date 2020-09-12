# frozen_string_literal: true

Gem::Specification.new do |spec|
  spec.name          = 'nereare_grimoire'
  spec.version       = '1.13.11'
  spec.authors       = ['Igor Padoim']
  spec.email         = ['igorpadoim@gmail.com']
  spec.license       = 'Hippocratic'

  spec.summary       = 'A jekyll quasi-wiki for RPG-oriented worldbuilding.'
  spec.homepage      = 'https://github.com/Nereare/Grimoire'

  spec.metadata['source_code_uri'] = spec.homepage
  spec.metadata['changelog_uri'] = 'https://github.com/Nereare/Grimoire/blob/master/CHANGELOG.md'
  spec.metadata['github_repo'] = 'https://github.com/Nereare/Grimoire.git'

  spec.files         = `git ls-files -z`.split("\x0").select do |f|
    f.match(%r{^((_includes|_layouts|_plugins|_sass|assets|css)/|(LICENSE|README|404)((\.(txt|md|markdown|html|scss|css)|$)))}i)
  end

  spec.platform = Gem::Platform::RUBY
  spec.required_ruby_version = '>= 2.5.0'

  spec.add_development_dependency 'html-proofer', '~> 3.15.1'
  spec.add_development_dependency 'nokogiri', '~> 1.10.8'

  spec.add_dependency 'jekyll-feed', '>= 0.12.1', '< 0.16.0'
  spec.add_dependency 'jekyll', '>= 4.0', '< 4.2'
  spec.add_dependency 'jekyll-redirect-from', '>= 0.15', '< 0.17'
  spec.add_dependency 'jekyll-seo-tag', '~> 2.6.1'
  spec.add_dependency 'jekyll-sitemap', '>= 1.3.1', '< 1.5.0'
  spec.add_dependency 'jemoji', '>= 0.11.1', '< 0.13.0'
end
