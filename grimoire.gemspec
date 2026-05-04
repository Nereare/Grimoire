# frozen_string_literal: true

Gem::Specification.new do |spec|
  spec.name          = 'nereare_grimoire'
  spec.version       = '1.21.0'
  spec.authors       = ['Igor Padoim']
  spec.email         = ['igorpadoim@gmail.com']
  spec.license       = 'Nonstandard'

  spec.summary       = 'A jekyll quasi-wiki for RPG-oriented worldbuilding.'
  spec.homepage      = 'https://github.com/Nereare/Grimoire'

  spec.metadata['source_code_uri'] = spec.homepage
  spec.metadata['changelog_uri'] = 'https://github.com/Nereare/Grimoire/blob/master/CHANGELOG.md'
  spec.metadata['documentation_uri'] = 'https://nereare.github.io/Grimoire'
  spec.metadata['bug_tracker_uri'] = 'https://github.com/Nereare/Grimoire/issues'
  spec.metadata['github_repo'] = 'https://github.com/Nereare/Grimoire.git'

  spec.files         = `git ls-files -z`.split("\x0").select do |f|
    # f.match(%r{^((_includes|_layouts|_plugins|_sass|assets|css)/|(LICENSE|README|CHANGELOG|404|adventures_collection|chapters_collection|monsters_collection|posts_collection|settlements_collection|spells_collection|ages_collection|animals_collection|plants_collection|items_collection|search)((\.(txt|md|markdown|html|scss|css|js|json)|$)))}i)
    f.match(%r{^(((_layouts|_plugins|assets|assets\/favicon|assets\/css)\/)+[0-9a-z\-\_]+\.[a-z]+)|((404|CHANGELOG|LICENSE|OGL|README|[a-z]+_collection|search)\.[a-z]+)$}i)
  end

  spec.platform = Gem::Platform::RUBY
  spec.required_ruby_version = '>= 3.2.0'

  spec.add_development_dependency 'html-proofer', '~>5.2'
  spec.add_development_dependency 'nokogiri', '~>1.19'
  spec.add_development_dependency 'webrick', '~>1.9'

  spec.add_dependency 'jekyll-feed', '~>0.17'
  spec.add_dependency 'jekyll', '~>4.4'
  spec.add_dependency 'jekyll-redirect-from', '~>0.16'
  spec.add_dependency 'jekyll-seo-tag', '~>2.8'
  spec.add_dependency 'jekyll-sitemap', '~>1.4'
  spec.add_dependency 'jemoji', '~>0.13'
end
