<p align="center">
  <a href="#about-application">About Application</a>
  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#technologies">Technologies</a>
  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#how-to-run">How to Run</a>
  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#routes">Routes</a>
  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#project-status">Project Status</a>
  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#license">License</a>
</p>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://img.shields.io/github/stars/shunny2/scrim-games-api?style=social"><img src="https://img.shields.io/github/stars/shunny2/scrim-games-api?style=social" alt="Stars"></a>
<a href="https://img.shields.io/github/forks/shunny2/scrim-games-api?style=social"><img src="https://img.shields.io/github/forks/shunny2/scrim-games-api?style=social" alt="Forks"></a>
<a href="https://img.shields.io/github/license/shunny2/scrim-games-api?style=social"><img src="https://img.shields.io/github/license/shunny2/scrim-games-api?style=social" alt="License"></a>
</p>

## About Application

<b>Backend</b> application of the [Scrim Games](https://github.com/shunny2/scrim-games) project made in PHP with the Laravel framework.

For the development of <b>Scrim Games</b>, the most modern libraries that [React](https://reactjs.org/) and [Laravel](https://laravel.com/) can offer were used.

The [scrim-games-api](https://github.com/shunny2/scrim-games-api/) uses JSON Web Token authentication to validate its users.

API Documentation is available at: [/api/v1/docs](https://scrim-games-api.onrender.com/api/v1/docs)

## Technologies

<table>
  <thead>
  </thead>
  <tbody>
    <td>
      <a href="https://www.php.net/" title="PHP"><img width="128" height="128" src="https://www.php.net/images/logos/new-php-logo.svg" alt="PHP logo image." /></a>
    </td>
    <td>
      <a href="https://laravel.com/" title="Laravel"><img width="128" height="128" src="https://cdn.worldvectorlogo.com/logos/laravel-2.svg" alt="Laravel logo image." /></a>
    </td>
    <td>
      <a href="https://www.postgresql.org/" title="Postgres"><img width="128" height="128" src="https://cdn.worldvectorlogo.com/logos/postgresql.svg" alt="PostgreSQL logo image." /></a>
    </td>
    <td>
      <a href="https://swagger.io/" title="Swagger Documentation"><img width="128" height="128" src="https://static1.smartbear.co/swagger/media/assets/images/swagger_logo.svg" alt="Swagger logo image." /></a>
    </td>
    <td>
      <a href="https://www.heroku.com/" title="Heroku"><img width="128" height="128" src="https://cdn.worldvectorlogo.com/logos/heroku-1.svg" alt="Heroku logo image." /></a>
    </td>
    <td>
      <a href="https://www.docker.com/" title="Docker"><img width="128" height="128" src="https://cdn.worldvectorlogo.com/logos/docker.svg" alt="Docker logo image." /></a>
    </td>
  </tbody>
</table>

## How to Run

First, start by cloning the repository:
```shell
git clone https://github.com/shunny2/scrim-games-api
```

If you use docker, run the following command from the project root directory to build and run the project.
```bash
docker-compose up --build
```

Now that you are inside the container, run the command below to install all dependencies.
```bash
composer install
```

And finally, access the project URL:
[Welcome](https://localhost:8000)

## Routes

The image below describes the routes available by the application.

![routes](https://user-images.githubusercontent.com/72872854/201341324-8e6adcc7-f6ee-48ad-8412-b021fc38173a.png)

## Project Status

> Status: Completed.

## License

This project is under an [MIT](https://opensource.org/licenses/MIT) license.

<hr/>

<p align="center">Created by <a href="https://github.com/shunny2"><b>Alexander Davis</b></a>.</p>
