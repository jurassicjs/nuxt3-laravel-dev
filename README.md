## Hi there, Full Stack Jack here
I'm glad you found this awesome repo.

If you'd like a walk through of how nuxt3 and in particular this set up
works,

check out the Full Stack Jack Youtube Channel here :point_right: ![YouTube Channel Subscribers](https://img.shields.io/youtube/channel/subscribers/UCFDF_U_uoKc6MhIZPZKo5CA?label=FullStackJack&style=social)
<a href="https://www.youtube.com/channel/UCFDF_U_uoKc6MhIZPZKo5CA">FullStackJack Youtube Channel</a>.

## Connect with me



<div align="center">
<a href="https://github.com/rohrig" target="_blank">
<img src=https://img.shields.io/badge/github-%2324292e.svg?&style=for-the-badge&logo=github&logoColor=white alt=github style="margin-bottom: 5px;" />
</a>
<a href = "mailto:richard.t.rohrig@gmail.com?subject = Feedback&body = Message">
<img src=https://img.shields.io/badge/gmail-%23EE4831.svg?&style=for-the-badge&logo=gmail&logoColor=white alt=gmail style="margin-bottom: 5px;" />
</a>
<a href="https://www.youtube.com/channel/UCFDF_U_uoKc6MhIZPZKo5CA" target="_blank">
<img src=https://img.shields.io/badge/youtube-%23EE4831.svg?&style=for-the-badge&logo=youtube&logoColor=white alt=youtube style="margin-bottom: 5px;" />
</a>
</div>

# Nuxt3, Laravel and Docker Development Environment from Jurassic Js

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)



### Prerequisites:
>Have docker and docker-compose installed on your machine.

### Getting Started:
>you'll also need to set up your /etc/hosts file to match whatever name you have for the server in the nginx setup found here:
```
config/nginx/sites-dev/jurassicjs.eu/.conf
```
The default is:

>dev.jurassicjs.eu

/etc/hosts should have an entry that looks like this:
```dotenv
127.0.0.1  dev.jurassicjs.eu my.dev.jurassicjs.eu
```
> I don't know anything about windows.
> If you're on a windows machine, and you know what to do in this instance,
> please update this readme and create a pull requests
> (5000 Cool Points will be deposited to your Karma Account upon merge)

```bash
git clone git@github.com:jurassicjs/nuxt3-dev.git
```
cd into the root of the project and run
```bash
docker-compose up -d
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Richard Rohrig](https://github.com/phpsquad)
- [All Contributors](https://github.com/phpsquad/domain-maker/contributors)

## Security

If you discover any security-related issues, please email richard.t.rohrig@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
185.199.111.133
