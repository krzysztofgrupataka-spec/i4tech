# UWAGI DO WWW - lista wdrożeniowa

Źródło: `UWAGI DO WWW (1).pdf`. Status odzwierciedla stan po zmianach zapisanych w panelu 25.09.2026 oraz zmianach przygotowanych lokalnie w motywie.

- [x] 1a. Ustawić kolejność kafelków na stronie głównej - już była prawidłowa.
- [ ] 1b. Zmienić animacje kafelków chemii i automatyzacji - potrzebne wybrane, licencjonowane materiały.
- [~] 1c. Zagospodarować puste kafelki - zwiększono tytuły kafelków do 32 px; pozostałe warianty nie są wdrażane.
- [x] 2. Poprawić link „Poznaj nasz model działania” na „Jak działamy”.
- [x] 3. Usunąć przykładowe referencje z „Jak działamy”.
- [~] 4. Ujednolicić widoczność logo w hero - nagłówek nad hero jest bez tła z białym logo osadzonym w szablonie; po przewinięciu wraca pełne białe tło i zwykłe logo.
- [x] 5. Przygotować odwracalne ukrywanie sekcji blogowych i pobierania materiałów - przełącznik dodany, a sekcje materiałów wyłączone na stronach technologii.
- [x] 6. Ukrywać sekcje blogowe na podstronach - usunięte ze stron rozwiązań; strona Blog i link w stopce pozostają zgodnie z projektem Figma.
- [~] 7. Naprawić formularz i dodać kontakt Jakuba - konfiguracja formularza jest poprawiona; dane Jakuba są globalnie dostępne pod opisem każdego bloku formularza, a kontakt dodano na trzech stronach rozwiązań.
- [~] 8. Poprawić układ pojedynczego case study - gotowe w kodzie; po wgraniu buildu pojedyncza karta będzie miała niski poziomy układ ze zdjęciem po lewej oraz żółtą częścią 65/35 z CTA wyrównanym do dolnej krawędzi.
- [~] 9. Ustawić metadane case study jako Sektor, Typ projektu i opcjonalny Inwestor - gotowe w kodzie.
- [x] 10. Zachować elastyczne sekcje case study - nazwy nagłówków i liczba notatek są ustalane osobno dla każdej realizacji.
- [x] 11. Poprawić technologie rozwiązania „Oczyszczanie ścieków przemysłowych”.
- [x] 12. Poprawić technologie dla uzdatniania wody - pozostawiono tylko uzdatnianie wody pitnej i przemysłowej.
- [ ] 13. Podmienić treści „Magazynowanie i dozowanie chemii” - potrzebny zatwierdzony tekst.
- [x] 14. Ujednolicić wyrównanie hero technologii - wariant ustawiono w edytorze bloku: pięć technologii nadrzędnych ma nagłówek po lewej, a technologie podrzędne wyśrodkowany.
- [x] Technologie nadrzędne: w hero dodano odnośnik „Dowiedz się więcej”, prowadzący do pierwszej sekcji treści na tej samej stronie.
- [ ] Archiwum case studies: wdrożyć przygotowany szablon identyczny z archiwum bloga (wyróżniona pierwsza karta oraz siatka kolejnych kart). Wymaga wgrania pliku szablonu przez FTP.
- [ ] 15. Ujednolicić hierarchię nagłówków technologii.
- [ ] 16. Ujednolicić teksty technologii ściekowych.
- [ ] 17. Rozstrzygnąć pozostawienie animacji i kolorów tekstu.
- [ ] 18. Ulepszyć wizualnie archiwum case studies.
- [x] 19. Dodać brakujące pliki standardów i procedur - siedem dokumentów dodano do biblioteki mediów i przypisano do bloku na stronie „Jak działamy”.
- [x] 20. Poprawić Introl S.A. i zastąpić referencje odnośnikiem do case studies.
- [~] 21. Dodać obsługę działu serwisu w bloku kontaktowym - dane zapisano w WordPressie; wyświetlenie wymaga wgrania aktualnego szablonu i stylów przez FTP.
- [ ] 22. Rozjaśnić / podmienić zdjęcia ochrony powietrza - potrzebny właściwy materiał lub decyzja o filtrze.
- [ ] 23. Wyostrzyć zdjęcie linii technologicznych - potrzebny lepszy plik źródłowy, jeśli obecny jest nieostry.
- [ ] 24. Dodać szerokie zdjęcie dla automatyzacji - potrzebny materiał.
- [ ] 25. Podmienić zdjęcie chemii - potrzebny materiał.
- [ ] 26. Podmienić zdjęcie badań pilotażowych - potrzebny wskazany załącznik.
- [x] 27. Usunąć szerokie zdjęcie z odazotowania.
- [ ] 28. Ujednolicić zdjęcia rodzin technologii - wymaga materiałów i doboru obrazów.
- [ ] 29. Poprawić indeksy chemiczne - wymaga redakcyjnego przeglądu treści.

Legenda: `[x]` wykonane na stronie, `[~]` wykonane częściowo lub gotowe lokalnie w kodzie i oczekujące na wdrożenie, `[ ]` do zrobienia.

## Komentarze i uzasadnienie

| Punkty | Komentarz | Uzasadnienie decyzji |
|---|---|---|
| 1a | Kolejność kafelków już odpowiada dokumentowi. | Zmiana nie byłaby widoczna, więc nie wprowadzam zbędnej edycji. |
| 1b, 17 | Animacje chemii i automatyzacji oraz decyzja o ich pozostawieniu są otwarte. | Brakuje zaakceptowanych materiałów i ostatecznego kierunku; nie należy dobierać stocków bez potwierdzenia. |
| 1c | Tytuły kafelków rozwiązań mają teraz 32 px; nie dodano ikon ani mechanizmu rozwijania. | Większy tytuł lepiej wykorzystuje format dużego kafelka, zachowuje szybkie skanowanie i nie zwiększa złożoności interakcji. Wolna przestrzeń utrzymuje czytelność, daje oddech między tematami i pozostawia miejsce na materiał wizualny ujawniany po najechaniu. |
| 2 | Link modelu działania został poprawiony w WordPressie. | To jednoznaczny błąd kierowania użytkownika. |
| 3 | Przykładowe referencje zostały usunięte z „Jak działamy”. | Nie można publikować fikcyjnych opinii; treść jest odzyskiwalna z rewizji WordPressa. |
| 4 | Nagłówek nad hero jest bez tła i używa przekazanego białego logo. | Po przewinięciu strony i przy otwartym menu nagłówek wraca do pełnej bieli oraz zwykłego logo, co zapewnia czytelność na każdym tle. |
| 5, 6 | Kod dodaje przełącznik bloków wpisów oraz przełącznik „Wyświetlaj na stronie” w każdym bloku pobierania materiałów; sekcje materiałów wyłączono na stronach technologii: oczyszczanie powietrza, ścieków i spalin oraz uzdatnianie wody pitnej i przemysłowej. Sekcje blogowe usunięto też ze stron rozwiązań. | Przełącznik materiałów ukrywa blok tylko na froncie, a treść pozostaje w edytorze do późniejszego przywrócenia. Archiwum Blog i link w stopce pozostają zgodnie z Figma. |
| 7 | Formularz ma poprawione pola, odbiorców i nagłówki poczty. Dane Jakuba są ustawiane raz w Theme settings i wyświetlają się pod opisem wszystkich bloków formularza; kontakt dodano też na stronach Automatyzacja, Oczyszczanie ścieków i Uzdatnianie wody. | Jedno źródło danych eliminuje ryzyko różnic między blokami. Test wysyłki wymaga potwierdzenia odbioru u wskazanych adresatów. |
| 8 | Kod daje jedną kolumnę dla pojedynczego case study. | Eliminuje pustą drugą kolumnę bez wymuszania trzech realizacji. |
| 9 | Kod zachowuje Sektor i Typ projektu, a „Przedmiot współpracy” zastępuje opcjonalnym polem „Inwestor”. | Inwestor nie jest wyświetlany, gdy pole pozostaje puste. |
| 10 | Nazwy nagłówków w sekcjach case study są edytowalne dla każdej realizacji. Można wprowadzić dowolne nazwy, np. „Tło sytuacyjne”, „Wyzwania” albo „Rozwiązanie”, oraz dodać dowolną liczbę notatek. | Nie wymuszamy jednego schematu ani pary nagłówków. Każda realizacja może mieć układ zgodny z dostępną treścią. |
| 11 | Przypisania technologii ściekowych zostały poprawione w panelu. | Dokument wskazuje dokładnie dwie technologie: odzysk wody oraz oczyszczanie fizykochemiczne. |
| 12 | Ze strony „Uzdatnianie wody” usunięto błędne powiązanie z oczyszczaniem ścieków; pozostają technologie wody pitnej i przemysłowej. | Te dwa przypisania odpowiadają zakresowi rozwiązania wskazanemu w PDF. |
| 13 | Strona magazynowania chemii nadal wymaga kompletnej treści merytorycznej. | Nie zastępuję tekstu technicznego treścią wygenerowaną bez akceptacji eksperta. |
| 14 | Wariant hero jest ustawiany w edytorze bloku. Ustawiono „Domyślny” dla Oczyszczania spalin, powietrza i ścieków oraz uzdatniania wody pitnej i przemysłowej; strony podrzędne mają wariant „Wyśrodkowany”. | Rozwiązanie nie narzuca reguły w kodzie i pozwala ustawić wyjątek w konkretnym bloku, gdy będzie potrzebny. |
| 15-16 | Nagłówki technologii wymagają kontroli widoków każdej strony. | Ujednolicenie struktury nie może zniszczyć czytelności długich nazw. |
| 18 | Archiwum case studies wymaga osobnej oceny wizualnej. | Obecny wzorzec kart może wymagać jedynie retuszu, a nie przebudowy. |
| 19 | Do biblioteki mediów przesłano siedem dokumentów PDF i przypisano je do sekcji „Nasze standardy i procedury” na stronie „Jak działamy”. | Każda pozycja ma własny widoczny tytuł i prowadzi do właściwego pliku do pobrania. |
| 20 | Poprawiono Introl S.A. i odnośnik do case studies w panelu. | To jednoznaczna korekta nazwy oraz zgodna zamiana CTA. |
| 21 | W bloku kontaktowym zapisano „Dział serwisu” z adresem `serwis@i4t.pl`; style układają go pod działami kontaktowymi, bez ściskania kolumn. | Umożliwia edycję w bloku kontaktowym bez modyfikacji szablonu przy następnej zmianie. |
| 22-26 | Zdjęcia wymagają źródeł o odpowiedniej jakości lub wskazanych plików. | Filtr CSS nie naprawi zbyt ciemnego albo nieostrego materiału źródłowego. |
| 27 | Szerokie zdjęcie z technologii „Odazotowanie spalin” zostało usunięte w panelu. | Dokument jednoznacznie nakazuje jego usunięcie, bez wskazywania zamiennika. |
| 28 | Ujednolicenie rodzin zdjęć wymaga zatwierdzenia zestawu obrazów. | Automatyczna podmiana grozi użyciem niewłaściwego obrazu na technologii. |
| 29 | Indeksy chemiczne wymagają przejrzenia wystąpień w tekstach. | Globalna zamiana cyfr mogłaby uszkodzić daty, parametry i numery urządzeń. |

## Dodatkowe poprawki poza PDF

- [~] Blok danych kontaktowych: przy węższym panelu przełącza się na dwa słupy, bez pustej kolumny; numery telefonów nie łamią się w środku. Przycisk wysłania formularza i okrągła strzałka są wymuszone w jednym wierszu.
- [~] Białe logo w nagłówku zostało osadzone bezpośrednio w szablonie, więc nie wymaga już osobnego pliku obrazu na serwerze.
- [~] Blok wybranych case studies: przy jednej realizacji wyświetla się niski szeroki kafelek ze zdjęciem po lewej, a żółta część ma dwie kolumny: 65% dla oznaczenia i tytułu oraz 35% dla CTA wyrównanego do dołu. Oznaczenie ma szerokość treści, tytuł nie ma limitu `max-inline-size: 12ch`, a CTA pozostaje wewnątrz paddingu. Przy dwóch realizacjach wyświetlają się dwa mniejsze kafelki obok siebie.
