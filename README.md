# Users API + Weather Fetcher

A clean **Laravel** project that exposes a token‑ready REST API for users Crud and a console command that ingests weather data from the
OpenWeatherMap **/find** endpoint, saving it to MySQL for later use.  
A minimal Bootstrap welcome page (`/`) lets you trigger the main API calls
from the browser.

---

## 🖥 Prerequisitos

| Ferramenta | Versão mínima | Como instalar (macOS + Homebrew)                  |
| ---------- | ------------- | ------------------------------------------------- |
| PHP        | 8.3           | `brew install php@8.3`                            |
| Composer   | 2.7           | `brew install composer`                           |
| MySQL      | 8 .x          | `brew install mysql && brew services start mysql` |
| Git        | qualquer      | `brew install git`                                |

> Windows / WSL ou Linux usam os mesmos comandos via apt, choco ou winget. Nesse projeto estou com windows e wsl.

---

## 🚀 Setup rápido

```bash
git clone https://github.com/gbflores/users-api.git
cd users-api

cp .env.example .env                 # copie o .env
composer install                     # instala dependências PHP
php artisan key:generate             # gera APP_KEY

# Edite .env com suas credenciais
# DB_DATABASE=users_api
# DB_USERNAME=root
# DB_PASSWORD=secret
# WEATHER_API_KEY=precisa_gerar_uma_chave_no_site_abaixo
# WEATHER_API_URL="https://openweathermap.org/data/2.5/weather"

php artisan migrate                  # cria tables users + weathers
php artisan serve                    # http://127.0.0.1:8000

pode rodar depois o comando: php artisan weather:fetch "Nome da Cidade"
ex: php artisan weather:fetch "Canoas,BR"
retorno: Clima salvo: Canoas → 17.73 °C

criei um banco mysql na hostinger, caso necessário, pode me pedir os dados que repasso.
```
