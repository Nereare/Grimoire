---
title          : Post Title
author         : Author Name
date           : 2019-08-19

settlement:
  name         : Cityville
  type         : Small City
  size         : 4 acres
  demograpics:
    - race     : Human
      percent  : 70
    - race     : Half-elf
      percent  : 20
    - race     : Misc.
      percent  : 10
  population   : 1,000
  gp-limit     : 1,000
  wealth       : 10,000
  centres:
    - type     : Conventional Council
      name     : City Council
      align    : Lawful Good
  authorities:
    - class      : Warrior
      level      : 5
      title      : Constable
      name       : Urist McLeader

shops:
  - type       : Inn
    name       : The Prancing Pony
    owner:
      name     : Barliman Butterbur
      gender   : Male
      race     : Human
      class    : Commoner
      level    : 5
    location   : East Road
    desc       : A large wooden building with rooms for both humans and halflings alike.
    goods:
      name     : Specials
      list:
        - name : Sausage Sandwich and a Tankard of Bitter
          cost : 4sp
        - name : Goose Soup with Peas
          cost : 4sp
        - name : Duck and a Glass of Brandy
          cost : 4sp

houses:
  - type       : Small Cottage
    name       : ''
    location   : West Road, north of the hill
    desc       : A small wood building with only one room, filled to the brim with ale.
    people:
      - name   : Nob
        gender : Male
        race   : Halfling
        class  : Commoner
        level  : 1
        owner  : true
      - name   : Bob
        gender : Male
        race   : Halfling
        class  : Commoner
        level  : 1
    items:
      - name   : Money
        desc   : 2 gp, 11 sp and 45 cp

layout         : settlement
---

Settlement description here.
