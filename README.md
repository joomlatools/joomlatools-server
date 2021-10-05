<div align="center">
  <br>
  <h1>Joomlatools Pages Server</h1>
  <strong>Frictionless web publishing</strong>
</div>
<br>
<p align="center">
  <a href="https://www.php.net">
    <img src="https://img.shields.io/badge/PHP-v7.4-green.svg" alt="php version">
  </a>
   <a href="https://gitpod.io/from-referrer/">
    <img src="https://img.shields.io/badge/Gitpod-ready--to--code-blue?logo=gitpod" alt="GitPod badge">
  </a>
</p>

Welcome to the Joomlatools Pages Server codebase, our home-grown **web publishing platform** that powers all of [joomlatools.com](https://joomlatools.com). 

### What is Joomlatools Pages Server?

Joomlatools Pages Server is an application server for [Joomlatools Pages](https://github.com/joomlatools/joomlatools-pages).  It can be used both as as local development environment and/or to deploy applications in the cloud using any platform that supports Docker images, eg [Fly.io](https://fly.io/), [Google App Engine](https://cloud.google.com/appengine), [Google Cloud Run](https://cloud.google.com/run), [Digital Ocean App Plaform](https://www.digitalocean.com/products/app-platform/), [AWS Fargate](https://aws.amazon.com/fargate/), ...

Pages Server provides a great starting point for building Joomlatools Pages applications using PHP and is supported on  macOS, Linux, and Windows (via WSL2).

## Getting started

### Using your own IDE

Getting started is very easy, make sure you have [Docker Desktop installed](https://www.docker.com/products/docker-desktop) and a local [fork](https://docs.github.com/en/get-started/quickstart/fork-a-repo#fork-an-example-repository) or clone of this repo. Go to the root directory of your installation in command line and execute following command:

```
docker compose up
```

Then go to http://localhost and you should see the `Hello World!` greeting.

_Note_: Make sure you are not running any other application on port 80, if you are turn them off first.

### Using Gitpod IDE

[Gitpod](https://www.gitpod.io/) provides a super simple way to develop with Joomlatools Pages using [VSCode](https://code.visualstudio.com/), straight from the browser. To get started [fork](https://docs.github.com/en/get-started/quickstart/fork-a-repo#fork-an-example-repository) this repo and either:

1. Install the [Gitpod Chrome or Firefox extension](Gitpod Chrome or Firefox) and click the `Gitpod` button in the toolbar.
2. Go to `http://gitpod.io#[my-repo-url-goes-here]`

You can find all the documentation for Gitpod here: [https://www.gitpod.io/docs/](https://www.gitpod.io/docs/)

**Gitpod Demo**: If you want to give this repo a spin in Gitpod, just click this button and off you go. 

[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/joomlatools/joomlatools-pages-server)

## Architecture

Pages Server runs applications as a multi-process Docker container. The processes are supervised using S6 
overlay. While init systems like supervisord are better known, s6 is powerful, lightweight, easy to use, and plays nicely with docker (e.g. avoiding the pid 1 / zombie problem).

Each application is build on the [`pages-server`](https://github.com/joomlatools/joomlatools-pages-server/pkgs/container/pages-server) base image. It contains following:

- [Ubuntu 20.4](https://ubuntu.com/)
- [S6 Overlay v2.2](https://github.com/just-containers/s6-overlay)
- [Apache 2.4](https://httpd.apache.org/)
- [PHP 7.4](https://www.php.net/)
- [Swoole 4.7](https://www.swoole.co.uk/)

### Multi-process Docker

One of the oft-repeated Docker mantras is "one process per container". There's nothing inherently bad about running multiple processes in a Docker container. The more abstract "one thing per container" is our policy - a container should do one thing, such as "run a chat service" or "run gitlab." This may involve multiple processes, which is fine.

The other reason image authors shy away from process supervisors is they believe a process supervisor must restart failed services, meaning the Docker container will never die.

This does effectively break the Docker ecosystem - most images run one process that will exit when there's an error. By exiting on error, you allow the system administrator to handle failures however they prefer. If your image will never exit, you now need some alternative method of error recovery and failure notification.

Our policy is that if "the thing" fails, then the container should fail, too. We do this by determining which processes can restart, and which should bring down the container. For example, if cron or syslog fails, your container can most likely restart it without any ill effects, but if ejabberd fails, the container should exit so the system administrator can take action.

Our interpretation of "The Docker Way" is thus:

> Containers should do one thing. Containers should stop when that thing stops.

and the S6 init system is designed to do exactly that! Pages Server still behaves like other Docker images and fit in with the existing ecosystem of images.

## Sites

Each application can provide multiple websites. Sites are proxied through Apache and served by the build in FastCGI Swoole Server. A sites Apache vhost configurationn is automatically loaded from `/var/www/sites/[name]/config/apache/server.conf`

## Composer

An application only contains a single composer `/vendor` directory which contains all PHP libraries used by the application libraries, sites and services. The `/vendor` directory is located in `/srv/www/vendor`and composer installation happens during the Docker image build phase.

Composer requires are being handled with delay during `ONBUILD`, the base defines the minimal composer requires and the app that extends from base can define additional requires.

The [Composer Merge Plugin](https://github.com/wikimedia/composer-merge-plugin) is used to merge composer.json files from following locations:

- `/var/www/config/composer.json`
- `/var/www/services/*/composer.json`
- `/var/www/sites/*/composer.json`

During image build, when Composer is run it will parse these files and merge their configuration settings into the base configuration. This combined configuration will then be used when downloading additional libraries and generating the autoloader.

### composer.lock

If the application contains a `/var/www/config/compooser.lock` file composer will run `composer install` to install the specific versions of the libraries, if there is no `composer.lock`, it will run `composer update` to install the latest versions of the libraries.

If no `composer.lock` is provided the generated `composer.lock` is copied to `/var/www/config/composer.lock` to make it easy to commit it in the repo. Removing an existing lock file ensure the dependencies are updated.

### opcache preload

By default the complete `/vendor` directory is preloaded in opcache unless `APP_PRELOAD` is disabled. To ignore a specific directory or file paths from being preloaded add a `/var/www/config/preload_ignore.php` file that returns an array of
file paths relative to `.../vendor` to be ignored.

```php
<?php
return [
    '/path/to/file',
];
```

## Environment

The following is a list of application environment variables. Defaults are provided for each except the `APP_APIKEY` and `APP_NONCE` variables. Both are required for the application to run.

- `APP_ENV=production`
  The application environment _(default)_

- `APP_USER=www-data`
  The application user _(default)_

- `APP_ROOT=/var/www`
  Location of the Apache root _(default)_

- `APP_DATA=/srv/www`
  Location of the common code, /vendor etc. _(default)_

- `APP_DISK=/mnt/www`
  Location of the persistent storage _(default)_

- `APP_PRELOAD=on`
  Defines if opcache is preloaded from APP_DATA _(default)_

- `APP_CACHE=on`
  Globally enable the application cache _(default)_

- `APP_DEBUG=off`
  Globally enable application debug mode _(default)_

- `APP_APIKEY=`
  Bearer authentication token _(required)_

- `APP_NONCE=`
  Random number specific for the application _(required)_


A complete list of all environment variables can be found in [.env.default](https://github.com/joomlatools/joomlatools/joomlatools-pages-server/.env.default)


## Endpoints

The application provides following default HTTP(s) endpoints

### Status

- http://localhost/__ping
- http://localhost/__status-php (php-fpm status, local only)
- http://localhost/__status-apache (apache status, local only)

### Info

- http://localhost/__info/php-info
- http://localhost/__info/php-apc
- http://localhost/__info/php-fpm
- http://localhost/__info/php-opcache
- http://localhost/__info/php-xdebug (only if xdebug is enabled)

## Documentation

You can find all the documentation for Joomlatools Pages [in the wiki](https://github.com/joomlatools/joomlatools-pages-server/wiki). Happy coding!

## Contributing

Joomlatools Pages is an open source, community-driven project. Contributions are welcome from everyone.
We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## Contributors

See the list of [contributors](https://github.com/joomlatools/joomlatools-pages-server/contributors).

## License

Joomlatools Pages Server is open-source software licensed under the [AGPLv3 license](LICENSE.txt).

## Community

Keep track of development and community news.

* Follow [@joomlatoolsdev on Twitter](https://twitter.com/joomlatoolsdev)
* Read the [Joomlatools Developer Blog](https://www.joomlatools.com/developer/blog/)
* Subscribe to the [Joomlatools Developer Newsletter](https://www.joomlatools.com/developer/newsletter/)


[⬆ Back to Top](#Table-of-contents)