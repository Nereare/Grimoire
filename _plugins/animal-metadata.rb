module Jekyll
  module AnimalMetadata
    def animal_metadata(input)
      output = Array.new

      # Feeding Parse
      if input.key? "feeding"
        feeding = input["feeding"].values.compact.reject(&:empty?)
        if feeding.count == 2
          feeding = feeding[0] + ' (' + feeding[1] + ')'
        else
          feeding = feeding[0]
        end
        output.push feeding
      end

      # Sizes Parse
      if input.key? "sizes"
        sizes = input["sizes"]
        if sizes.class == Hash
          sizes = sizes["min"].to_s + "-" + sizes["max"].to_s + sizes["unit"] + " (" + sizes["type"] + ")"
        else
          sizes = sizes.to_s
        end
        output.push sizes
      end

      # Weight Parse
      if input.key? "weight"
        weight = input["weight"]
        if weight.class == Hash
          weight = weight["min"].to_s + "-" + weight["max"].to_s + weight["unit"]
        else
          weight = weight.to_s
        end
        output.push weight
      end

      # Habitat Parse
      if input.key? "habitat"
        habitat = input["habitat"].values.compact.reject(&:empty?)
        if habitat.count == 2
          habitat = habitat[0] + ' (' + habitat[1] + ')'
        else
          habitat = habitat[0]
        end
        output.push habitat
      end

      # IUCN Parse
      if input.key? "iucn"
        iucn = iucn(input["iucn"])
        output.push iucn
      end

      # Note Parse
      if input.key? "note"
        note = input["note"].to_s
        output.push note
      end

      return output
    end

    def iucn(input)
      case input
      when "EX"
        return "Extinct"
      when "EW"
        return "Extinct in the wild"
      when "CR"
        return "Critically endangered"
      when "EN"
        return "Endangered"
      when "VU"
        return "Vulnerable"
      when "NT"
        return "Near threatened"
      when "LC"
        return "Least concern"
      when "DD"
        return "Data deficient"
      when "NE"
        return "Not evaluated"
      else
        return ""
      end
    end
  end
end

Liquid::Template.register_filter(Jekyll::AnimalMetadata)
