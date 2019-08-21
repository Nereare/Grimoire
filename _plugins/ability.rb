module Jekyll
  module AbilityModFilter
    def ability(input)
      mod = (input - 10) / 2
      return input.to_s + " (" + (mod < 0 ? mod.to_s : "+" + mod.to_s) + ")"
    end
  end
end

Liquid::Template.register_filter(Jekyll::AbilityModFilter)
