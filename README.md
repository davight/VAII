# Weatherboy reporter

Dávid Gregor

5ZYI36

## Stručný opis projektu
Aplikácia je webový editor pre štylizáciu reportov počasia. Používaťel si na plátne poskladá vlastnú vizualizáciu z geometrických prvkov (čiara, obdĺžnik...) a "senzorov", ktoré budú zobrazovať rôzne štatistiky o počasí. (teplotu, vlhkosť, rýchlosť vetra). Ako zdroj dát pre tieto štatistiky sa bude používať hlavne Open-Meteo API.
**Napríklad:** 
Používateľ si pridá lokalitu Žilina a chce si vytvoriť grafickú kartu "Počasie v žiline". Na plátno si pridá nejaké dekorácie a vloží graf pre teplotu alebo vlhkosť. Následne si môže toto plátno zobraziť v "Kiosk" režime. Je to režim kde sa údaje budú automaticky aktualizovať a plátno sa maximalizuje na celú obrazovku.
Pokiaľ sa tak rozhodne bude môcť nastaviť toto plátno ako verejné. Teda ho budú môcť vidieť / používať aj iní, neprihlásení užívatelia.

## Role v projekte
| Typ | Oprávnenia |
| --- | --- |
| Návštevník | Môže si prezerať a používať (v kiosk móde) galériu verejných reportov |
| Používatel | Vidí svoje existujúce reporty, alebo si môže vytvoriť nové. Pripadne inak ich spravovať a meniť. |
| Správca | Môže spravovať reporty ostatných používateľov. Prípadne skryť niektoré verejné reporty. |

## Prípady použitia podľa rolí

### Návštevník
- prezrie si verejné reproty
- zobrazí detail verejného reportu, prípadne ho použije v jeho kiosk móde
- zaregistruje sa alebo prihlási

### Používateľ
- vytvorí si vlastný report a nadekoruje si ho ako chce
- nastaví report ako súkromný alebo verejný
- upraví alebo zmaže svoj report

### Správca
- vidí zoznam registrovaných užívateľov, môže zablokovať účet
- môže zmazať verejný report (napr. ak je nevhodny)

## Plánované entity
**User** (učet pouzivatela a jeho rola) - vlastní userlokality a reporty
- #id, username, rola

**Location** (lokalita, pre ktorú sa sťahuju dáta o počasí) - pouziva ju viacero užívateľov a zároveň obsahuje viacero senzorov
- #id, nazov

**UserLocation** (spoj medzi lokalitou a uzivatelom)
- #id_usera a #id_lokality

**Sensor** (jedna meraná veličina v konkrétnej lokalite) - patrí jednej lokalite (1:N)
- #id, id_lokality, metrika, jednotka

**SensorData** (nameraná hodnota v danom čase) - patrí 1 senzoru (1:N)
- #id, id_senzora, hodnota, čas

**Report** (platno s prvkami) - patrí 1. užívateľovi (1:N)
- #id, nazov, dimenzie, id_usera

## Vzťahy medzi entitami
- User M:N location (cez UserLocation) - používateľ môže mať viacero lokalít a zároveň jedna lokalita môže mať viacero užívateľov.
- Location 1:N Sensor - v jednej lokalite je viac senzoro (teplota, vlhkosť...)
- Sensor 1:N SensorData - jeden sensor ma viacero dat v rôznych časoch
- User 1:N Report - používateľ môže vytvoriť viac reportov

## Hlavné stránky aplikácie
1. Úvodná stránka: galéria verejných reportov 
2. Registrácia / prihlásenie: možnosť sa prihlásiť alebo registrovať 
3. Moje reporty: zoznam reportov s možnosťou ich nejak spravovať
4. Editor reportu: plátno s panelom nástrojov kde si uživateľ bude upravovať svoj vizual reportu
6. Administrácia: správa používateľov a moderovanie verejných reportov 

## Rozdelenie funkcionality

### Základné funkcie:
- registrácia a prihlásenie, role (používateľ a správca)
- CRUD reportov
- editor s plátnom
- pridanie lokality a sťahovanie dát z Open-Meteo do databázy
- verejná galéria reportov a nastavenie viditeľnosti
- správa správcom
- spustenie v Dockeri s example dátami

### Rozširujúce funkcie
- automatická aktualizácia dát
