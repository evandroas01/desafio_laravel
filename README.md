# Laravel: Blog Application

## Project Specifications

**Read-Only Files**
- tests/*

**Environment**  

- PHP version: 8.1
- Laravel version: 10.10
- Default Port: 8000

**Commands**
- run: 
```bash
php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000
```
- install: 
```bash
composer install
```
- test: 
```bash
php artisan migrate:refresh && ./vendor/bin/phpunit tests --log-junit junit.xml
```
    
## Question description

In this challenge, your task is to implement blog application with blade view pages to manage a blog articles.

Each article has the following structure:

- `id`: The unique ID of the blog. (Integer)
- `title`: The title of the blog. (String)
- `author`: Name of the author of the blog. (String)
- `content`: content of the blog. (String)

### Example of an blog JSON object:
```
{
    "id": 1,
    "title": "New photography exhibition",
    "content": "In a new exhibition at the Royal Botanic Garden Edinburgh, famous photographer explores the astonishing diversity of nature.",
    "author": "Oscar Davies",
}
```

## Requirements:

You are provided with the implementation of the Blog model:

`GET /`:

- in `home.blade.php` file create table with following fields
- No, Title, Author and Action
- in action column set two buttons edit and delete
- edit button name must be `Edit`, url need to be `GET` - `/blog/edit/:id` and delete button name must be `Delete`, url need to be `POST` - `/blog/edit/:id`
- above this table set create blog button and it's name must be `Create Blog`, url need to be `GET` - `/blog`

`GET` `/blog`:

- in `blog.blade.php` file create one form with post method
- title field name must be `title`
- author field name must be `author`
- content field name must be `content`
- create button text must be `Create`

`POST` `/blog`:
- create request validation
- title, author and content is required, The content must be at least 50 characters.
- redirect on home page for a successful 201 response with success message

`GET` `/blog/edit/:id`:

- in `editblog.blade.php` file create with one form in post method
- title field name must be `title`
- author field name must be `author`
- content field name must be `content`
- create button text must be `Update`

`PUT` `/blog/edit/:id`:

- create request validation
- Update a particular blog as per request blog id
- title, author and content is required, The content must be at least 50 characters.
- redirect on home page for a successful 201 response with success message

`DELETE` `/blog/delete/:id`:

-   Delete a particular blog as per request blog id
-   redirect on home page for a successful response with success message
