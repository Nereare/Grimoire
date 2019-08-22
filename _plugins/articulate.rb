module Jekyll
  module ArticulateFilter
    def articulate(input, capital = false)
      art = (/^[AEIOUY].+/.match?(input) ? 'an' : 'a')
      if capital then art.capitalize! end
      return art + " " + input
    end
  end
end

Liquid::Template.register_filter(Jekyll::ArticulateFilter)
