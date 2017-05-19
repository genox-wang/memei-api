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
| READ        | GET/categories/{id}/authors| categories.authors | CategoriesController@authors|
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
| READ        | GET/photos/uptoken         | photos.uptoken     | PhotosController@uptoken    |


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



### 那些坑

#### MassAssignmentException

Model需要设置`$fillable`或者`guarded`，否者请求通过Http请求调用的`create`方法会报`Illuminate\Database\Eloquent\MassAssignmentException`错误

#### Seeder不能手动创建

Seeder只能通过`artisan make:seeder`创建，手动创建的无法找到

#### Dingo严格模式

`API_STRICT=true`，严格模式下请求必须加上Header必须加上`Accept:application/vnd.LtApi.v1+json`

#### Dingo调试模式

调试模式默认不开启，需要配置`API_DEBUG=true`，在开发阶段建议开启，方便找到错误。

#### Eloquent 一对多嵌套不行

`Category::find($id)->authors()->cards()`,这样调用不可行，那多层嵌套查询的话，暂时没找到好办法，就算有也比较复杂，要合并多表键值还是不会，有待挖掘。用SQL的话也就一句话

```php
DB::select('select a.title,a.id as card_id,b.name,b.id as author_id,c.name,c.id as category_id from cards a, authors b, categories c where a.author_id = b.id and b.category_id = c.id and c.id = ?',[$id])
```

我承认比较长，但好用，相对熟练！

#### Relation转Collection

```php
Card::findOrFail($id)->photos();//Relation
Card::findOrFail($id)->photos()->get();//Collection
```
