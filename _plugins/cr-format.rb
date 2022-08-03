module Jekyll
  module CRFormat
    def cr_format(input)
      case input
      when 0
        return "0 (0 XP or 10 XP)"
      when "1/8"
        return "1/8 (25 XP)"
      when "1/4"
        return "1/4 (50 XP)"
      when "1/2"
        return "1/2 (100 XP)"
      when 1
        return "1 (200 XP)"
      when 2
        return "2 (450 XP)"
      when 3
        return "3 (700 XP)"
      when 4
        return "4 (1,100 XP)"
      when 5
        return "5 (1,800 XP)"
      when 6
        return "6 (2,300 XP)"
      when 7
        return "7 (2,900 XP)"
      when 8
        return "8 (3,900 XP)"
      when 9
        return "9 (5,000 XP)"
      when 10
        return "10 (5,900 XP)"
      when 11
        return "11 (7,200 XP)"
      when 12
        return "12 (8,400 XP)"
      when 13
        return "13 (10,000 XP)"
      when 14
        return "14 (11,500 XP)"
      when 15
        return "15 (13,000 XP)"
      when 16
        return "16 (15,000 XP)"
      when 17
        return "17 (18,000 XP)"
      when 18
        return "18 (20,000 XP)"
      when 19
        return "19 (22,000 XP)"
      when 20
        return "20 (25,000 XP)"
      when 21
        return "21 (33,000 XP)"
      when 22
        return "22 (41,000 XP)"
      when 23
        return "23 (50,000 XP)"
      when 24
        return "24 (62,000 XP)"
      when 25
        return "25 (75,000 XP)"
      when 26
        return "26 (90,000 XP)"
      when 27
        return "27 (105,000 XP)"
      when 28
        return "28 (120,000 XP)"
      when 29
        return "29 (135,000 XP)"
      when 30
        return "30 (155,000 XP)"
      else
        return "&mdash;"
      end
    end
  end
end

Liquid::Template.register_filter(Jekyll::CRFormat)
