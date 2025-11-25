# 🏸 Upravljavnik za turnirje

Badminton Tournament Manager je CakePHP aplikacija za vodenje turnirjev v badmintonu.

Glavna ideja:
- imaš **turnir**,
- znotraj njega **dogodke** (kategorije),
- na dogodek prijaviš **tekmovalce** (posamezniki ali pari),
- aplikacija **samodejno generira vse pare** (brez ponavljanja),
- ob vnosu ali spremembi rezultata **ponovno preračuna** zmage, poraze in statistiko.

---

## ✨ Funkcionalnosti

- 🏁 **Turnirji (tournaments)**  
  Ustvarjanje in urejanje turnirjev (naziv, datum, lokacija, opis).

- 🎯 **Dogodki (tournament_events)**  
  Kategorije znotraj turnirja (npr. "Moški pari", "Ženske posamezno", "Mix").  
  Vsak dogodek ima svoje tekmovalce in svoje tekme.

- 👥 **Igralci (players)**  
  Centralni seznam vseh igralcev (ime, klub ipd.).

- 👫 **Tekmovalci (competitors)**  
  Povezava igralcev na konkreten dogodek.  
  Tekmovalec je lahko:
  - posameznik (1 igralec) ali  
  - par (2 igralca), odvisno od tipa dogodka.

- 🏓 **Tekme (tournament_matches)**  
  Za vsak dogodek se generirajo pari med tekmovalci:
  - algoritmično se ustvarijo **vse kombinacije** tekmovalcev,
  - **isti par se ne ponovi** večkrat,
  - ob spremembi rezultata se statistika za oba tekmovalca ponovno izračuna.

- 📊 **Statistika**  
  Po dogodku lahko vidiš:
  - število odigranih tekem,
  - zmage / poraze,
  - točke (če jih vnašaš),
  - razmerje.

---

## 🏗️ Tehnične informacije

- **Framework:** CakePHP (4/5 – odvisno od tvoje verzije)
- **Baza:** MariaDB / MySQL (lahko prilagodiš tudi na PostgreSQL)
- **Struktura:** klasičen CakePHP MVC (Table, Entity, Controller, Template)
- **Migrate/Seed:** uporablja migracije in seed podatke za osnovno strukturo in testne vnose

Tipične tabele (poimenovanje se sklada z CakePHP konvencijo):

- `tournaments`
- `tournament_events`
- `tournament_matches`
- `players`
- `competitors`

---

## 🚀 Namestitev (osnovni koraki)

Namesti docker in docker composer. [Navodila](https://docs.docker.com/compose/install).

```bash
git clone https://github.com/USERNAME/badminton-tournament.git
cd badminton-tournament

composer install

cp config/app_local.example.php config/app_local.php
# v config/app_local.php nastavi povezavo na bazo

bin/cake migrations migrate
bin/cake migrations seed

bin/cake server
```

Nastavitve baze - dodaj v config/app_local.php.
```bash
'default' => [
            'className' => \Cake\Database\Connection::class,
            'driver' => \Cake\Database\Driver\Sqlite::class,
            'database' => ROOT . DS . 'db' . DS . 'tournament.sqlite',
            'encoding' => 'utf8',
            'persistent' => false,
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'log' => true,
        ],
```

# 🏸 Badminton Tournament Manager

Badminton Tournament Manager is a CakePHP application for managing badminton tournaments.

The main idea:
- you create a **tournament**,
- inside it you define **events** (categories),
- the application automatically generates all match **pairings** (without repetition),
- the application **automatically generates all match pairings** (without repetition),
- when entering or updating a result, **it recalculates** wins, losses, and statistics.

---    

## ✨ Features

### 🏁 Tournaments (`tournaments`)
Create and manage tournaments:
- name  
- date  
- location  
- description

### 🎯 Events (`tournament_events`)
Categories within a tournament (e.g., “Men Doubles”, “Women Singles”, “Mixed”).  
Each event contains:
- its own competitors  
- its own matches  

### 👥 Players (`players`)
A central list of all players:
- name  
- club  
- additional info  

### 👫 Competitors (`competitors`)
Links players to a specific event.  
A competitor can be:
- a single player (singles), or  
- a pair of two players (doubles),  
depending on the event type.

### 🏓 Matches (`tournament_matches`)
For each event, the system automatically generates match-ups:
- all possible combinations of competitors  
- no duplicate pairings  
- when the result of a match changes, statistics for both competitors are recalculated

### 📊 Statistics
For each event you can view:
- total matches played  
- wins / losses  
- points (if used)  
- win ratio  

---

## 🏗️ Technical Information

- **Framework:** CakePHP (version 4 or 5)  
- **Database:** MariaDB / MySQL (PostgreSQL supported with minor changes)  
- **Architecture:** Classic CakePHP MVC (Table, Entity, Controller, Template)  
- **Migrations/Seeds:** Used for schema creation and test data

Tables follow CakePHP naming conventions:

- `tournaments`  
- `tournament_events`  
- `tournament_matches`  
- `players`  
- `competitors`
  
## Avtorji
- Andraž Prinčič (vodja razvoja)
- Rok Meglič (pomočnik)
