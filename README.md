<h1>Aplikacja "Little Places"</h1>
Aplikacja jest realizowana na przedmiot Projektowanie Aplikacji Internetowych. 
<h2>Informacje ogólne</h2>
Aplikacja pozwala na tworzenie ogłoszeń, które są "przypięte" na mapie i widoczne dla wszystkich użytkowników. Każde ogłoszenie składa się z tytułu, opisu, zdjęcia i lokalizacji. Utworzone ogłoszenia są przypisane do użytkownika, który może je edytować lub usunąć.

Użytkownicy mogą śledzić ogłoszenia co powoduje dodanie dowolnego ogłoszenia do ich personalnej listy. Dzięki temu mają możliwość odnalezienia tego ogłoszenia szybciej niż w przypadku ogólnego widoku.


<h2>Widoki aplikacji</h2>
Aplikacja składa się z kilku widoków podzielonych na grupy:
- widoków przed zalogowaniem:
  - widok logowania ```/login```
  - widok rejestracji ```/register```
    - pełna walidacja
  - widok odzyskiwania hasła (widok istnieje, ale usługa odzyskiwania hasła jest nie zaimplementowana) ```/```
- widok główny ```/dashboard``` z dwoma wariantami:
  - widok mapy (ogłoszenia w postaci punktów)
  - widok siatki (ogłoszenia w postaci kafelków)
- widok śledzonych ogłoszeń ```/followed``` z dwoma wariantami:
  - widok mapy (ogłoszenia w postaci punktów)
  - widok siatki (ogłoszenia w postaci kafelków)
- widoki ogłoszeń użytkownika (których jest właścicelem):
  - widok przeglądu wszystkich ogłoszeń użytkownika ```/announcements```
  - widok edycji i dodwania nowego ogłoszenia ```/edit_announcement``` ```/new_announcement```
- widok opcji ```/options```
  - zmiana zdjeci aprofilowego
  - zmiana informacji pojawiającej się pod profilem (bio)
  - możliwość wylogowania ```/logout``` (następuje również po ręcznym wpisaniu ```/register```, ```/login``` lub nic przekierowywuje do widoku głównego dopóki użytkownik się nie wylogował/ciasteczko nie wygasło)


Wszystkie widoki są dostosowane zarówno do ekranów komputera jak i urządzeń mobilnych.
W przypadku urządzeń mobilnych niektóre widoki są dzielone na mniejsze, w których widać tylko kawałek strony, ale między którymi można się swobodnie przełączać, bez ładowania strony od nowa.

<h3>Model bazy danych:</h3>
<img src="./database_model.svg">

<h3>API </h3>
(dostępne endpointy nie zwracające całej strony html, lecz informacje w postaci JSON)
