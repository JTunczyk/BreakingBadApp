# BreakingBadApp (WAŻNE)

Framework: Laravel.

Aplikacja stworzona na potrzeby rekrutacji do Web Falcon. (Strona jest w pełni responsywna)

Aby aplikacja poprawnie działała, należy zrobić migracje tabeli "ocena_aktora" oraz "utworz_konta" które znajdują się w \database\migrations.

Wykorzystane API: https://breakingbadapi.com

Strona posiada system oceniania w postaci serduszek oraz posiada system rejestracji, logowania (Przy rejestracji jest również wdrożony system tokenów potwierdzających, ale maile nie są wysyłane w razie błędu (serwer lokalny), a bez zalogowania się nie można przetestować aplikacji).

Użytkownik posiada możliwość wyświetlenia poprzednio ocenionych postaci.

W przypadku chęci ustawienia wlasnego pliku .env oraz posiadania vendorów z archiwum .zip należy wypakować folder "no_vendors".

Jeśli baza danych znajduje się na serwerze lokalnym (np. XAMPP) oraz potrzebne są vendory wypakować "with_vendors".

## Przetestowane na przeglądarkach: 
Edge 85

Chrome 84

Opera 70

Firefox 79

Internet Explorer 11
