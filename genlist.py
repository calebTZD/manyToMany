import random
import json
import mysql.connector
import uuid

names = []
races = ['dwarf', 'elven', 'halfling', 'dragonborn', 'teifling', 'human', 'orc', 'goblin', 'uruk', 'bugbear']
guilds = ['paladin', 'sorcerer', 'wizard', 'necromancer', 'thief', 'ranger', 'barbarian', 'cleric', 'warrior', 'druid']
objects = ['sword', 'bow', 'mace', 'axe', 'flail', 'spear', 'crossbow', 'trident', 'hammer', 'sling', 'staff', 'dagger',
            'helmet', 'breasplate', 'boots', 'bracers', 'pauldran', 'shield',
            'ring', 'amulet', 'rope', 'bag', 'food', 'potion', 'familiar']

# fict names copied from https://www.britannica.com/topic/list-of-fictional-characters-2045983
f = open("fict_names.txt", encoding="utf8")
for line in f:
    items = line.split("(")
    try:
        if len(items) > 1:
            print(items[0].rstrip())
            names.append(items[0].rstrip())
    except:
        print("unable to add name")

#fant names copied from http://www.angelfire.com/tx/afira/fantasymfull.html
f = open("fantasy_names.txt", encoding="utf8")
for line in f:
    items = line.split("\t")
    try:
        if len(items) == 3:
            names.append(items[0].rstrip())
            if len(items[1])>2:
                names.append(items[1].rstrip())
            if len(items[2])>2:
                names.append(items[2].rstrip())
    except:
        print("unable to add name")

f.close()

dbconn = mysql.connector.connect(user='root', 
                              password='',
                              host='127.0.0.1')
cursor = dbconn.cursor()
cursor.execute("DROP DATABASE testy")
cursor.execute("CREATE DATABASE testy")
cursor.execute("USE testy")
cursor.execute('CREATE TABLE players (id BINARY(16) NOT NULL, pname VARCHAR(100), race VARCHAR(40), guild VARCHAR(40), PRIMARY KEY(id))')
cursor.execute('CREATE TABLE items (id BINARY(16) NOT NULL, iname VARCHAR(100), PRIMARY KEY(id))')
cursor.execute('CREATE TABLE player_item (playerid BINARY(16) NOT NULL, itemid BINARY(16) NOT NULL)')
cursor.execute('ALTER TABLE player_item ADD CONSTRAINT playitem UNIQUE (playerid, itemid)')

itemMap = dict()
for item in objects:
    uid = uuid.uuid1()
    itemMap[item] = uid
    query = 'INSERT INTO items (id, iname) VALUES ("%i", "%s")' % (uid, item)
    print(item)
    print(query)
    cursor.execute(query)
    dbconn.commit()
print(itemMap)

for name in names:
    uid = uuid.uuid1()
    query = 'INSERT INTO players (id, pname, race, guild) VALUES ("%i", "%s", "%s", "%s")' % \
             (uid, name, random.choice(races), random.choice(guilds))
    print(query)
    cursor.execute(query)
    items = []
    for i in range(0, random.randint(3, 5)):
        item = random.choice(objects)
        if not item in items:
            items.append(item)
    for item in items:
        query = 'INSERT INTO player_item (playerid, itemid) VALUES ("%i", "%i")' % \
             (uid, itemMap[item])
        print(query)
        cursor.execute(query)
dbconn.commit()
dbconn.close()

#SELECT playr.pname, itm.iname FROM players AS playr LEFT JOIN player_item AS pitem ON playr.id = pitem.playerid LEFT JOIN items AS itm ON itm.id = pitem.itemid
