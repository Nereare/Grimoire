module Jekyll
  module OrdinalFilter
    def ordinal(input)
      ending = ''
      case input % 100
      when 11, 12, 13 then ending = 'th'
      else
        case input % 10
        when 1 then ending = 'st'
        when 2 then ending = 'nd'
        when 3 then ending = 'rd'
        else ending = 'th'
        end
      end

      return input.to_s + ending
    end
  end
end

Liquid::Template.register_filter(Jekyll::OrdinalFilter)
