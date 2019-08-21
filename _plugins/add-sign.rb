module Jekyll
  module AddSignFilter
    def add_sign(input)
      return input < 0 ? input.to_s : "+" + input.to_s
    end
  end
end

Liquid::Template.register_filter(Jekyll::AddSignFilter)
