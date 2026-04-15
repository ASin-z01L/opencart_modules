## Shortcodes

### Module Description

The module allows inserting standard OpenCart modules (HTML blocks and banners) anywhere within the text description 
of products, categories, and articles using shortcodes.


### Operating Instructions

**Module Creation:** Go to the Extensions / Extensions menu, select the "Modules" extension type, create a module 
(HTML or Banner), and give it a name starting with the prefix sc_ (e.g., sc_promo).

**Adding to Layout:** In the "Design — Layouts" section, add the created module to the **right column** 
(this is important! it will not work in other areas) of the required "Category", "Product", or "Information" layout.

- ***General Layout:*** the module will be available in all objects of this type. (For example, the "Category" layout)

- ***Individual Layout:*** only for a specific page. (A user-created layout)

**Insertion:** In the description of a category, product, or article, insert the code [sc_name] (e.g., [sc_promo]). 
When the page is rendered, the module will replace the shortcode with the prepared HTML text or a standard banner grid 
(taking into account the specified image sizes). If a shortcode is inserted into the text but there is no module with 
a corresponding name in the layout, the shortcode will be removed from the text. Blocks placed in the right column of 
the layout that have the sc_ prefix in their name will not be displayed in the right column of the site.

**Usage Example:** Suppose you need to place a phone number in the descriptions of dozens of products and articles. 
Create an HTML block named sc_phone and enter the number there. In the texts, add the [sc_phone] shortcode everywhere.

**Advantages:** If the number changes, you only need to update it once in the module settings. The changes will 
immediately take effect on all pages of the site where the shortcode is specified.


### Versions

The module has been tested on clean builds of OpenCart 2.1, 2.3. If the module does not work correctly when installed 
on your site, it is possible that your system files or templates have already been modified.


### License
MIT


=======================================


### Описание модуля

Модуль позволяет вставлять стандартные модули OpenCart (HTML-блоки и баннеры) в любое место текстового описания
товаров, категорий и статей с помощью коротких кодов (шорткодов).


### Инструкция по работе

**Создание модуля:** Перейдите в меню Дополнения / Расширения, выберите тип расширения «Модули», создайте модуль
(HTML или Баннер) и задайте ему название, начинающийся с префикса sc_ (например, sc_promo).

**Добавление в схему:** В разделе «Дизайн — Схемы (Макеты)» добавьте созданный модуль в **правую колонку** (это важно! 
в других областях работать не будет) нужного макета "Категории", "Товар" или "Информационная страница".

- ***Общая схема:*** модуль будет доступен во всех объектах этого типа. (Например схема "Category")

- ***Индивидуальная схема:*** только для конкретной страницы. (Созданная пользователем схема)

**Вставка:** В описании категории, товара или статьи вставьте код [sc_название] (например, [sc_promo]). При выводе
страницы модуль заменит шорткод на готовый HTML-текст или стандартную сетку баннера (с учетом заданных размеров изображений). 
Если шорткод вставлен в текст, а соответствующего ему по названию модуля нет в схеме, шорткод будет удален из текста.
Блоки, размещенные в правой колонке схемы, имеющие префикс sc_ в названии, не будут выведены в правую колонку сайта.

**Пример использования:** Допустим, вам нужно разместить номер телефона в описаниях десятков товаров и статей.
Создайте HTML-блок с названием sc_phone и впишите туда номер.
В текстах, везде добавьте шорткод [sc_phone].

**Преимущества:** Если номер изменится, вам достаточно обновить его один раз в настройках модуля. Изменения моментально
вступят в силу на всех страницах сайта, где указан шорткод.


### Версии

Модуль протестирован на чистых сборках OpenCart 2.1, 2.3. Если при установки на ваш сайт, модуль работает не корректно,
возможно ваши системные файлы или шаблоны уже подвергались изменениям.


### Лицензия
MIT
