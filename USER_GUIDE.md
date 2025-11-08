# 📘 Uporabniška navodila – Badminton Tournament Manager

Ta dokument opisuje tipičen potek dela: od ustvarjanja turnirja do vnašanja rezultatov in pregleda končne razpredelnice.

---

## 1. Priprava igralcev

Najprej si pripravi seznam igralcev.

1. V meniju izberi **Players / Igralci**.
2. Klikni **Add / Dodaj**.
3. Vnesi podatke (npr. ime, priimek, klub…).
4. Shrani.

To ponoviš za vse igralce, ki bodo nastopili na turnirju.

---

## 2. Ustvarjanje turnirja

1. V meniju izberi **Tournaments / Turnirji**.
2. Klikni **Add / Dodaj**.
3. Vnesi:
   - **Naziv turnirja** (npr. "Badminton Open 2025"),
   - **Datum**,
   - po želji **lokacijo** in **opis**.
4. Shrani.

Po shranitvi imaš prazen turnir, v katerega boš dodal **dogodke** (kategorije).

---

## 3. Dodajanje dogodkov (kategorij)

1. Na strani turnirja ali v meniju izberi **Tournament Events / Dogodki**.
2. Klikni **Add / Dodaj**.
3. Izberi:
   - turnir, na katerega se dogodek navezuje,
   - naziv dogodka (npr. "Moški pari", "Ženske posamezno", "Mix"),
   - po želji dodatne nastavitve (npr. opis, opombe…).
4. Shrani.

Za vsak turnir lahko ustvariš več dogodkov (kategorij).

---

## 4. Prijava tekmovalcev na dogodek

Tekmovalec je "ekipa" v posameznem dogodku – to je lahko:
- en igralec (posamezno) ali
- par (dva igralca) pri dvojicah.

1. V meniju ali na strani dogodka izberi **Competitors / Tekmovalci**.
2. Klikni **Add / Dodaj**.
3. Izberi:
   - dogodek,
   - igralca ali igralca 1 + igralca 2 (če gre za par),
   - po želji še opis/opombe (npr. naziv ekipe).
4. Shrani.

Postopek ponoviš za vse tekmovalce v tem dogodku.

---

## 5. Generiranje tekem (parov)

Ko ima dogodek vse tekmovalce vnešene:

1. Odpri **dogodek** (view stran).
2. Klikni gumb tipa **"Generiraj tekme" / "Generate matches"** (ime gumba je lahko rahlo drugačno).
3. Sistem:
   - pregleda vse tekmovalce v tem dogodku,
   - generira pare tako, da **vsak igra proti vsakemu** (round-robin),
   - poskrbi, da **isti par ne nastopi dvakrat**,
   - za vsak par ustvari zapis v `tournament_matches`.

Po generiranju boš na dogodku videl seznam tekem.

> Opomba: generiranje običajno narediš šele, ko je seznam tekmovalcev dokončen.

---

## 6. Vnos rezultatov

1. Odpri **Tournament Matches / Tekme** (običajno filtrirano po dogodku ali preko linka iz dogodka).
2. Klikni **Edit / Uredi** pri tekmi, kateri želiš vnesti rezultat.
3. Vnesi rezultat:
   - odvisno od tvoje implementacije:
     - bodisi seti (npr. "21:15, 19:21, 21:17"),
     - bodisi samo končne točke,
     - ali pa označiš zmagovalca in vneseš osnovne podatke.
4. Shrani.

Po shranitvi:

- sistem določi zmagovalca,
- poveča število **zmag** pri zmagovalcu in **porazov** pri poražencu,
- po potrebi posodobi še točke / razliko točk.

---

## 7. Spreminjanje rezultatov in ponovni preračun

Če narediš napako ali se rezultat spremeni:

1. Odpri tekmo in ponovno klikni **Edit / Uredi**.
2. Popravi rezultat.
3. Shrani.

Sistem ob tem:
- **odšteje** prejšnjo statistiko,
- **zapiše novo** statistiko,
- zagotovi, da so zmage/porazi in morebitne točke v tabeli aktualne.

Ni potrebno ročno popravljati razpredelnice – vse se preračuna avtomatično.

---

## 8. Pregled razpredelnice (rang lista)

Na strani dogodka (event) imaš običajno zavihek ali tabelo z rezultati, kjer za vsakega tekmovalca vidiš:

- ime tekmovalca (oz. para),
- število odigranih tekem,
- zmage,
- poraze,
- po potrebi točke +/– in razliko,
- vrstni red (rang).

To ti omogoča, da na koncu hitro razglasiš zmagovalca in končno uvrstitev.

---

## 9. Tipičen potek uporabe

1. Dodaj vse **igralce**.
2. Ustvari **turnir**.
3. Ustvari **dogodke** (kategorije).
4. Na vsak dogodek prijavi **tekmovalce** (posamezniki ali pari).
5. Za vsak dogodek zaženi **generiranje tekem**.
6. Med turnirjem vnašaj **rezultate tekem**.
7. Po potrebi **popravi rezultate** – sistem preračuna statistiko.
8. Na koncu preglej **razpredelnico** in določi zmagovalce.

---

## 10. Opombe za administratorje

- pred generiranjem tekem preveri, da ima dogodek vse tekmovalce,
- če po generiranju dodaš nove tekmovalce, moraš se odločiti, ali:
  - ponovno generiraš tekme (in pobrišeš stare) ali
  - nove tekme dodaš ročno (odvisno od tvojega scenarija),
- sistem ne bo sam vzdrževal "double elimination" ali playoff dreves, ampak je fokus na:
  - **vseh parih brez ponavljanja** in
  - **pravilnem preračunu statistik**.

---

*Verzija dokumenta: 1.0 (osnova, prilagodi glede na dejanske gumbe in polja v tvojem UI).*
