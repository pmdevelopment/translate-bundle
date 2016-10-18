# translate-bundle
Google Translate API Bundle

## Config.yml

```yml
pm_translate:
    api_key: '%google_api_translate_key%'
    *from: de*
    *to: en*
```

## Usage

```php
    /*
     * Default Language
     */
    $translation = $this->get('pm_translate.services.translation_service')->translate($keywordName);
    
    /*
     * Custom Language
     */
    $translation = $this->get('pm_translate.services.translation_service')->translate($keywordName, 'en', 'fr');
```