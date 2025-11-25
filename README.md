# 🏸 Badminton Tournament Manager

## 🌐 Languages
- 🇸🇮 [Slovenščina](README.sl.md)

---
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
  
## Authors
- Andraž Prinčič
- Rok Meglič
