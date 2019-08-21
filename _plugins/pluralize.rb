module Jekyll
  module PluralizeFilter
    def pluralize(input, singular, plural)
      return input.to_s + " " + (input == 1.abs ? singular.to_s : plural.to_s)
    end
  end
end

Liquid::Template.register_filter(Jekyll::PluralizeFilter)
