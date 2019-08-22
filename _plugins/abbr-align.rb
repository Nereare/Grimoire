module Jekyll
  module AbbrAlignFilter
    def abbr_align(input)
      case input
      when "Lawful Good"
        return "LG"
      when "Lawful Neutral"
        return "LN"
      when "Lawful Evil"
        return "LE"
      when "Neutral Good"
        return "NG"
      when "Neutral Evil"
        return "NE"
      when "Chaotic Good"
        return "CG"
      when "Chaotic Neutral"
        return "CN"
      when "Chaotic Evil"
        return "CE"
      else
        return "N"
      end
    end
  end
end

Liquid::Template.register_filter(Jekyll::AbbrAlignFilter)
