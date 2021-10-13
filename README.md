# [Madcoders](https://www.madcoders.co) Sylius Taxon Gallery Plugin

## Features
- pick categories which you want to promote on main page 
- re-use taxon images or
- upload own image

## Requirements
| | Version |
| :--- | :--- |
| PHP  | 7.4, 8.0 |
| Sylius | 1.9, 1.10 |

## Installation

1. Add as dependency in `composer.json`
```shell
composer require madcoders/sylius-taxon-gallery-plugin
```

2. Enable plugin in `config/bundles.php`:
```php
Madcoders\SyliusTaxonGalleryPlugin\MadcodersSyliusTaxonGalleryPlugin::class => ['all' => true],
```    

3. Import required config in `config/packages/_sylius.yaml` file:
```yaml
imports:
    - { resource: "@MadcodersSyliusTaxonGalleryPlugin/Resources/config/config.yml" }
```  

4. Import routes `config/routes.yaml` file:
```yaml
madcoders_sylius_taxon_gallery_plugin:
    resource: "@MadcodersSyliusTaxonGalleryPlugin/Resources/config/routing.yaml"
```
5. Run migrations:
```bash
php bin/console doctrine:migrations:migrate
```

## Development

* See [How to contribute](docs/CONTRIBUTING.md)

## License

This library is under the [EUPL 1.2](LICENSE) license.

## Credits

![madcoders logo](docs/img/madcoders-logo-slogan.png)

Developed by [MADCODERS](https://madcoders.co)    
Architects of this package:
- [Piotr Lewandowski](https://github.com/plewandowski)
- [Leonid Moshko](https://github.com/LeoMoshko)

<a href="https://www.buymeacoffee.com/madcoders" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>
