## Küfür Filtresi
Paket, string ifadelerde küfür filtresi yapılması için hazırlanmıştır. Paket dile bağlı çalışabilmektedir. Şu an da sadece Türkçe için kelime listeleri bulunmaktadır. 
**Paket her türlü geliştirmeye açıktır.**

- **soft.txt** isimli dosyada yer alan terimler ancak tek başına bir kelime olarak kullanıldığında filtrelenmesi gereken terimlerdir. Bir kelime içerisinde geçtiğinde filtrelenmesi gerekmeyen bir kelime olabilir.
- **hard.txt** isimli dosyada yer alan terimler ise başka herhangi bir kelime içerisinde geçse bile filtrelenmesi gereken, temiz bir kelimenin içerisinde geçme ihtimali çok zor olan terimlerdir.


## Installation

Kurmak için composer kullanılmalıdır.

``` bash
composer require dawnstar/curse
```


Aşağıdaki satırlar `config/app.php` dosyasına eklenmelidir.

```php
return [

    'providers' => [
        ...
        
        \Curse\Providers\CurseServiceProvider::class,
    ],
    
    
    'aliases' => [
        ...
        
        'Curse' => \Curse\Facades\CurseFacade::class,
    ],
];
```

## Usage


Here are a few examples using periods 
```php
//Soft File dosyasının yolunu set etmeyi sağlar
//Dosyaların içindeki kelimeler satır satır ayrılmalıdır.
$curse = Curse::setSoftFile(public_path('soft.txt'));

//Filtrelenecek küfürlerin olduğu dosyaları çekmek için
$hard_file_words = Curse::getHardFile();
$soft_file_words = Curse::getSoftFile();

//Filtrelenecek text'in ve yerine yazılacak text'in set edilmesi,
//init fonksiyonu ile filtreleme gerçekleştirilir. 
//init fonksiyonuna parametre verilerek ("soft" | "hard") istenilen türde filtreleme yapılabilir.
$filtered_text = Curse::setText("Filtrelenmesi istenen text")
        ->setReplacementText("***")
        ->init();
```

## Note
Paket başka repository'den esinlenerek yapılmıştır. [Orjinal Paket](https://github.com/90pixel/kufur-filtresi)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
