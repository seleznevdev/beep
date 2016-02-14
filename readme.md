# Beep :mega:

Beep is a lovely way to notify your team using [Slack](https://slack.com) or [HipChat](https://hipchat.com). Inspiration and the initial code was taken from [Laravel Envoy](https://github.com/laravel/envoy).

## Installation

Require the `seleznev/beep` package using [Composer](https://getcomposer.org/):
```bash
composer require seleznev/beep
```

Add the service provider in `config/app.php` to `providers` array:
```php
Seleznev\Beep\ServiceProvider::class,
```

Add the alias in `config/app.php` to `aliases` array:
```php
'Beep' => Seleznev\Beep\Facade::class,
```

For the Laravel **5.0** you should add `'Seleznev\Beep\ServiceProvider',` and `'Beep' => 'Seleznev\Beep\Facade',` respectively.

## Configuration

To get started, you'll need to create a [Slack token](https://api.slack.com/web) or a [HipChat token](https://hipchat.com/admin/api).

Add your `SLACK_TOKEN` and `HIPCHAT_TOKEN` to the `.env` file.

## Usage

Send a message to a Slack channel:
```php
Beep::slack('#channel')->say('Hi');
```

Send a message to a HipChat room:
```php
Beep::hipchat('room')->say('Hi');
```

Send a message from a chosen name:
```php
Beep::slack('#channel')->from('My application')->say('Hi');
```

A few attractive examples:

```php
public function report(Exception $e)
{
    parent::report($e);

    $message = App::environment().': '.$e->getMessage();

    Beep::slack('#logs')->say($message);
}
```

```php
Post::created(function ($post) {
    $message = "*{$post->user->name}* has created _{$post->title}_ post!";

    Beep::slack('#activity')->say($message);
});

Post::created(function ($post) {
    $message = "<b>{$post->user->name}</b> has created <i>{$post->title}</i> post!";

    Beep::hipchat('activity')->say($message);
});
```

## Lumen

Add the service provider in `bootstrap/app.php` to `Register Service Providers` block:
```php
$app->register(Seleznev\Beep\ServiceProvider::class);
```

```php
app('beep')->slack('#channel')->say('Lumen');
```

## License

Beep is licensed under [The MIT License (MIT)](https://github.com/seleznevdev/beep/blob/master/LICENSE).
