# Brio Package
Brio is the simple, yet powerful templating engine for [Mako Framework](https://github.com/mako-framework).

## Installing Brio
1. Unzip package into a packages directory within your application's root directory.  
2. Add dependency in `composer.json` file:
```json
"require": {
	"php": ">=7.0.0",
	"mako/framework": "5.7.*",
	"packages/brio": "*"
}
```
And add local repository path:
```json
"repositories": [
    {
        "type": "path",
        "url": "packages/brio",
        "options": {
            "symlink": true
        }
    }
]
```
3. Rur `composer install` or `composer update` command in console terminal.