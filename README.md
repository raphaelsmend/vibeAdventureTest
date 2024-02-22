<p align="center">
    <a href="https://go.dev/" target="_blank">
        <img src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/272486839/original/fc57038166a74a4909c66f9a3731e37f67ff4222/create-professional-website-using-php-mysql-laravel-vue-js.jpg" width="400">
    </a>
</p>

# Technical test

## Technical test for developing api backend using laravel and frontend using vuejs3. this project was developed using containers.

<!--ts-->
* [Frameworks used](#frameworks-used)
* [Prerequisites](#prerequisites)
* [Cloning repository](#clonning)
* [Installing](#installing)
* [Running](#running)
* [Swagger](#swagger)
<!--te-->

Frameworks used
============
- <a hfef="https://laravel.com/" target="_blank">Laravel</a>
- <a hfef="https://vuejs.org/" target="_blank">VueJS</a>
- <a hfef="https://primevue.org/autocomplete/" target="_blank">PrimeVUE</a>
- <a hfef="https://tequila.kiwi.com/portal/docs/tequila_api/locations_api" target="_blank">Tequila Locations API</a>
- <a hfef="https://www.docker.com/" target="_blank">Docker</a>

Prerequisites
============

```bash
- Linux (or WSL on windows)
- latest version of docker and docker-compose
```

Cloning repository
============

```bash
$ git clone git@github.com:raphaelsmend/vibeAdventureTest.git
```
Installing
============

```bash
$ cd vibeAdventureTest/
$ docker compose build
```
Running
============
```bash
$ docker compose up -d

access the url http://localhost and make some searchs
```

Observations
============
before start your searchs, add line "TEQUILA_API_KEY=" in laravel-app/.env file