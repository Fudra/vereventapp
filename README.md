# Verevent

## Voraussetzung

- PHP Dempedency Manager [composer](https://getcomposer.org/)
- Einen Webserver 
	- Für Mac: [Laravel Valet](https://laravel.com/docs/5.5/valet)
	- Für Windows: [XAMPP](https://www.apachefriends.org/de/index.html)
- Datenbank z.B. MySQL
- Redis
- Account bei [Mailtrap](https://mailtrap.io) zum E-Mail testen
  
## Installation

- `cp .env.example .env`
- Abhängigkeiten Installieren: `composer install`
- Anwendungs Key generieren: `php artisan key:generate`
- JWT- Geheimnis gegerieren: `php artisan jwt:secret`
- `.env` Bearbeiten und eigene Datenbank verbindung hinzufügen
- Datenbank Migration `php artisan migrate`
- Optional: `npm install` / `yarn`


## Benutzung

- Starten des Queue Servers: `php artisen queue:work`
- Den Taks Scheduler ausführen: `php artisan schedule:run`, alternativ als [CronJob](https://laravel.com/docs/5.6/scheduling#introduction)

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```
