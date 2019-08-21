module Jekyll
  module PrettyNumberFilter
    def pretty_number(input)
      return input.to_s.reverse.gsub(/(\d{3})(?=\d)/, '\\1,').reverse
    end
  end
end

Liquid::Template.register_filter(Jekyll::PrettyNumberFilter)
