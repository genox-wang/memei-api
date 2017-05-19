# Eloquent 使用笔记

## API需求

### 根据资源设计

参考[创建符合规范的API接口- Build API For Your Company 系列](https://laravel-china.org/topics/130/two-to-create-a-compliant-api-interface-build-api-your-company-series-for)

#### 资源 migrations

```php

// Category : 类别
Schema::create('categories', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
});

// Author: 作者

Schema::create('authors', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('category_id');
    $table->string('name');
    $table->string('avatar');
});

// Card: 专辑
Schema::create('cards', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('author_id');
    $table->string('title');
    $table->integer('favorite');
    $table->timestamps();
});

// Photo: 照片
Schema::create('photos', function (Blueprint $table) {
   $table->increments('id');
   $table->integer('card_id');
   $table->string('key');
});

```

#### 资源CRUD API

| Action      | Endpoint                   | Route Name         | Controller                  |
| :---------  | :-------------             | :-------------     | :-----------------          |
| CREATE      | POST/cards                 | cards.store        | CardsController@store       |
| READ        | GET/cards                  | cards.index        | CardsController@index       |
| READ        | GET/cards/{id}             | cards.show         | CardsController@show        |
| READ        | GET/cards/{id}/photos      | cards.photos       | CardsController@photos      |
| PUT         | PUT/cards/{id}             | cards.update       | CardsController@update      |
| DELETE      | DELETE/cards/{id}          | cards.delete       | CardsController@delete      |
| CREATE      | POST/categories            | categories.store   | CategoriesController@store  |
| READ        | GET/categories             | categories.index   | CategoriesController@index  |
| READ        | GET/categories/{id}        | categories.show    | CategoriesController@show   |
| READ        | GET/categories/{id}/cards  | categories.cards   | CategoriesController@cards  |
| PUT         | PUT/categories/{id}        | categories.update  | CategoriesController@update |
| DELETE      | DELETE/categories/{id}     | categories.delete  | CategoriesController@delete |
| CREATE      | POST/authors               | authors.store      | AuthorsController@store     |
| READ        | GET/authors/               | authors.index      | AuthorsController@index     |
| READ        | GET/authors/{id}           | authors.show       | AuthorsController@show      |
| READ        | GET/authors/{id}/cards     | authors.cards      | AuthorsController@cards     |
| PUT         | PUT/authors/{id}           | authors.update     | AuthorsController@update    |
| DELETE      | DELETE/authors/{id}        | authors.delete     | AuthorsController@delete    |
| CREATE      | POST/photos                | photos.store       | PhotosController@store      |
| DELETE      | DELETE/photos              | photos.delete      | PhotosController@delete     |
| READ        | GET/oss/uptoken            | oss.uptoken        | OSSController@uptoken       |


### APP相关

#### 按专辑分页

- 全部专辑：GET/api/cards
- 指定类型专辑：GET/api/categories/{id}/cards
- 指定作者专辑：GET/api/authors/{id}/cards
- 排序：?order=create_at/favorite

#### 专辑图片搜索

- 指定专辑所有图片：GET/api/cards/{id}/photos

### 管理后台相关

- 展示所有类别：GET/api/categories
- 展示所有作者：GET/api/authors
- 展示所有专辑：GET/api/cards
- 展示所有图片：GET/api/photos
- 添加类别：POST/api/categories
- 添加作者：POST/api/authors
- 添加专辑：POST/api/cards
- 获取OSS口令：GET/oss/uptoken
- 添加图片：POST/api/photos
