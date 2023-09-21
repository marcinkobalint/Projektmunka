Egy oldal működtetéséhez több különböző fájlban is kell írni kódot!

A kód teljes működtetésére szükség lesz a Composer (terminal utasítások) és a XAMPP (MySQL elérés) letöltésére!

# FÁJLOK
## routes/web.php
- Itt kell megírni az elérési útvonalat egy Blade-hez (mondhatni ez a html rész a programban).
- Egyelőre csak rámutat a blade fájlra, később ezt egy létrehozott Controllerben (pl. BejelentkezesController) kell majd megírni.
- Route::get elég olyan oldalaknál, ahol nem történik submit.
- Route::post kell olyan oldalaknál, ahol van submit (Route::get is kell!).

## resources/views
- Ebben a mappában kell létrehozni a Blade-eket a programhoz (pl. bejelentkezes.blade.php).
- A Blade-ben szerepelhet CSS, HTML, JS vagy akár PHP rész is, bár azt inkább a Controller részbe ajánlom már.
- Ha a JS vagy CSS részt máshol akarod tárolni, azt a public mappán belül tudod megtenni.

## database/migrations
- Itt található a Laravel által alapértelmezetten elkészített SQL táblák.
- A mi esetünkben a create users table könnyen felhasználható a bejelentkezés / regisztrációs felületre, bár érdemes kicsit átalakítani.
- Ha le van töltve a Composer és a XAMPP, 'akkor a php artisan migrate' utasítással fel tudjuk vinni a táblákat a MySQL szerverünkre.
   - Ez jelenleg localhoston működik, szóval az oda felvitt adat nem kerül át másnak a gépére.
- Ha frissíteni kell a táblákat, azt a 'php artisan migrate:fresh' utasítással tudja megtenni.
   - Ez az összes feltöltött adatot kitörli!

## app/Models
- Itt kell létrehozni a migrations-ban megadott tábláknak Modelleket. (pl. Tanar.php)
- Ennek segítségével tudja elmenteni a szerveren a PHP kód a felhasználó által felvitt adatokat.

## app/Http/Controllers
- Itt lehet létrehozni Controllereket a különböző függvények és Blade-ek működésére (pl. BejelentkezesController.php).
- Személy szerint én itt mentem el a felhasználó általá adott adatokat, illetve itt ellenőrzöm a helyességüket is.

# PROGRAM MŰKÖDÉSE
Egyelőre még nincs se adatbázis kidolgozva, illetve a Bejelentkezés funkció sem csinál semmit, ezért migrationra még nincs szükség.
A szerver LOKÁLIS futtatásához be kell írni a terminalba a 'php artisan serve' utasítást, majd a terminálon keresztül megnyitni az oldalt.
A bejelentkezés oldalát a '/bejelentkezes' oldalon megtalálod!

Később, ha már használjuk az SQL rendszerünket, ne felejtsétek átírni az '.env.example' fájlt '.env' fájlra ha az nem létezik!!