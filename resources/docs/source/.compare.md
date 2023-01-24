---
title: API Reference

language_tabs:
- php

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://scma-api.test/docs/collection.json)

<!-- END_INFO -->

#Category


<!-- START_14c3d186e6fae88a0bf94b2bbc728937 -->
## Move Catgory Data

Use this api to re-assign any other category to events and sites

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://scma-api.test/api/v1/categories/changeCategory',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'old_department_id' => 3,
            'department_id' => 2,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`PUT api/v1/categories/changeCategory`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `old_department_id` | integer |  required  | Id of category you want to replace.
        `department_id` | integer |  required  | Id of category you want data to move in.
    
<!-- END_14c3d186e6fae88a0bf94b2bbc728937 -->

<!-- START_80420c095ed96da032c9eb419d7d6e2d -->
## Fetch Categories

This endpoint retrieves all Categories

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://scma-api.test/api/v1/categories',
    [
        'query' => [
            'total'=> '5',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "name": "Fire Control Management"
        },
        {
            "id": 2,
            "name": "Emergency Services"
        },
        {
            "id": 5,
            "name": "Public Services"
        },
        {
            "id": 6,
            "name": "Human Resources"
        },
        {
            "id": 7,
            "name": "Technology"
        }
    ]
}
```

### HTTP Request
`GET api/v1/categories`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | Specific category you want to retrieve.
    `name` |  optional  | Search by category name
    `total` |  optional  | Number of categories you want to retrieve. Defaults to 20.

<!-- END_80420c095ed96da032c9eb419d7d6e2d -->

<!-- START_51652a01dd7666395568dd6ba9d67d58 -->
## Add Category

This endpoint use to create a category

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://scma-api.test/api/v1/categories',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'name' => 'News-Report',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`POST api/v1/categories`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Name of the category.
    
<!-- END_51652a01dd7666395568dd6ba9d67d58 -->

<!-- START_58b09cda1a6b4241d0b8f55289d7bd09 -->
## Update Category
Update the specified Category in storage.

Use this api to Update category.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://scma-api.test/api/v1/categories/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'name' => 'News-Report',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`PUT api/v1/categories/{category}`

`PATCH api/v1/categories/{category}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | int required Id of the category.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | Name of the category.
    
<!-- END_58b09cda1a6b4241d0b8f55289d7bd09 -->

<!-- START_75b173cefee1332cf71f9d29370afde7 -->
## Delete Category

Use this api to Delete specific category.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete('http://scma-api.test/api/v1/categories/1');
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/v1/categories/{category}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The id of the specific Category.

<!-- END_75b173cefee1332cf71f9d29370afde7 -->

#Crawl Logs


<!-- START_48b59eb4b66d4c19ff2f6edbb3162dd9 -->
## Fetch Crawl Logs

This endpoint retrieves all crawl logs

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://scma-api.test/api/v1/crawl_logs',
    [
        'query' => [
            'total'=> '2',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 39551,
            "description": "Error while crawling https:\/\/www.bain.com\/offices\/moscow - Curl Error No 28 Info: {\"url\":\"https:\/\/www.bain.com\/offices\/moscow\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":474,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":4.999888,\"namelookup_time\":0.004205,\"connect_time\":0.007795,\"pretransfer_time\":0.036517,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":0,\"starttransfer_time\":0,\"redirect_time\":0,\"certinfo\":[],\"primary_ip\":\"104.18.16.68\",\"primary_port\":443,\"local_ip\":\"192.168.2.150\",\"local_port\":32906,\"redirect_url\":\"\"}",
            "date_time": "2021-04-14 16:45:12"
        },
        {
            "id": 39550,
            "description": "Error while crawling https:\/\/www.bain.com\/offices\/milan - Curl Error No 28 Info: {\"url\":\"https:\/\/www.bain.com\/offices\/milan\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":473,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":5.000519,\"namelookup_time\":0.0042,\"connect_time\":0.007801,\"pretransfer_time\":0.035644,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":0,\"starttransfer_time\":0,\"redirect_time\":0,\"certinfo\":[],\"primary_ip\":\"104.18.16.68\",\"primary_port\":443,\"local_ip\":\"192.168.2.150\",\"local_port\":32904,\"redirect_url\":\"\"}",
            "date_time": "2021-04-14 16:45:12"
        }
    ]
}
```

### HTTP Request
`GET api/v1/crawl_logs`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `total` |  optional  | Number of crawl_logs you want to retrieve. Defaults to 20.

<!-- END_48b59eb4b66d4c19ff2f6edbb3162dd9 -->

#Event


<!-- START_9c9fa65f9a287d3c60b4d2a602b09fba -->
## Fetch Events

This endpoint retrieves all events along with categories

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://scma-api.test/api/v1/events',
    [
        'query' => [
            'total'=> '2',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "name": "Covid-19 Pandemic Impact On Business",
            "keywords": null,
            "match_condition": "(^covid^ or ^corona^) and (^virus^ or ^pandemic^) and (^cybercrime^ OR ^fraud^ OR ^phishing^ OR ^leaked^ OR ^hacked^ OR ^ransomware^ OR ^ddos^ OR ^online theft^ OR ^online fraud^ OR ^online bullying^ OR ^fake account^ OR ^hackers^ OR ^online crime^)",
            "search_type": "and",
            "google_keywords": "",
            "crawl_type": 0,
            "crawl_status": 1,
            "event_lock": 1,
            "categories": [
                {
                    "category_id": 1,
                    "name": "Fire Control Management"
                },
                {
                    "category_id": 2,
                    "name": "Emergency Services"
                },
                {
                    "category_id": 5,
                    "name": "Public Services"
                },
                {
                    "category_id": 6,
                    "name": "Human Resources"
                }
            ]
        },
        {
            "id": 11,
            "name": "Test Event",
            "keywords": null,
            "match_condition": "^merge^",
            "search_type": "and",
            "google_keywords": "",
            "crawl_type": 0,
            "crawl_status": 0,
            "event_lock": 1,
            "categories": [
                {
                    "category_id": 2,
                    "name": "Emergency Services"
                }
            ]
        }
    ]
}
```

### HTTP Request
`GET api/v1/events`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | Specific event you want to retrieve by id.
    `name` |  optional  | Search by event name
    `total` |  optional  | Number of events you want to retrieve. Defaults to 20.

<!-- END_9c9fa65f9a287d3c60b4d2a602b09fba -->

<!-- START_40b2dca13b49082417bca22e110bb0d1 -->
## Add Event

This endpoint use to create an event

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://scma-api.test/api/v1/events',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'name' => 'News-Report',
            'keywords' => 'dubai-traffic, dubai-airport',
            'google_keywords' => 'crime, politics',
            'categories' => [
                [
                    'category_id' => '1',
                ],
                [
                    'category_id' => '2',
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`POST api/v1/events`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | name of the event.
        `keywords` | string |  required  | You can add multiple keywords comma (,) seperated.
        `google_keywords` | string |  optional  | You can add multiple keywords comma (,) seperated.
        `categories[0][category_id]` | array |  optional  | Associate any category to event by category_id.
        `categories[1][category_id]` | array |  optional  | Associate any category to event by category_id.
    
<!-- END_40b2dca13b49082417bca22e110bb0d1 -->

<!-- START_a7d1daec0d745b4205a48e97a2c75a82 -->
## Update Event

This endpoint use to update an event

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://scma-api.test/api/v1/events/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'name' => 'News-Report',
            'keywords' => 'dubai-traffic, dubai-airport',
            'google_keywords' => 'crime, politics',
            'categories' => [
                [
                    'category_id' => '1',
                ],
                [
                    'category_id' => '2',
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`PUT api/v1/events/{event}`

`PATCH api/v1/events/{event}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | name of the event.
        `keywords` | string |  required  | You can add multiple keywords comma (,) seperated.
        `google_keywords` | string |  optional  | You can add multiple keywords comma (,) seperated.
        `categories[0][category_id]` | array |  optional  | Associate any category to event by category_id.
        `categories[1][category_id]` | array |  optional  | Associate any category to event by category_id.
    
<!-- END_a7d1daec0d745b4205a48e97a2c75a82 -->

<!-- START_6f004e557b115c6d4cc94d1ef7352907 -->
## Delete Event

Use this api to Delete specific Event.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete('http://scma-api.test/api/v1/events/1');
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/v1/events/{event}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The id of the specific Event.

<!-- END_6f004e557b115c6d4cc94d1ef7352907 -->

<!-- START_711537553256c889bbf28c6deb6a6f39 -->
## Immediate Crawl Event

Use this api to perform immediate crawl on event.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://scma-api.test/api/v1/crawl_job',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'event_id' => '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`POST api/v1/crawl_job`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `event_id` | required |  optional  | The id of the specific Event.
    
<!-- END_711537553256c889bbf28c6deb6a6f39 -->

<!-- START_d1376fc5f988be1bb72f4177b8b65c92 -->
## Crawl Job Status

Use this api to perform immediate crawl on event.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://scma-api.test/api/v1/crawl_status/1',
    [
        'query' => [
            'id'=> '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "topic_id": 14,
        "status": "in_progress",
        "no_of_sites": 1,
        "site_completed": 0,
        "completed_at": null,
        "created_at": "2021-06-14 19:07:05",
        "updated_at": "2021-06-15 00:49:18"
    }
}
```

### HTTP Request
`GET api/v1/crawl_status/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | The id of the specific crawl Job.

<!-- END_d1376fc5f988be1bb72f4177b8b65c92 -->

#Global Keyword


<!-- START_73eb856017f89d5ef5d7ec9c26103a39 -->
## Fetch Global Keywords

This endpoint retrieves all Global Keyword

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://scma-api.test/api/v1/globals',
    [
        'query' => [
            'total'=> '5',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": []
}
```

### HTTP Request
`GET api/v1/globals`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | Specific Global Keyword you want to retrieve.
    `name` |  optional  | Search by Global Keyword
    `total` |  optional  | Number of Global Keyword you want to retrieve. Defaults to 20.

<!-- END_73eb856017f89d5ef5d7ec9c26103a39 -->

<!-- START_f63780d889b0eaa1108bbb4632c51044 -->
## Add Global Keyword

This endpoint use to create a global keyword

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://scma-api.test/api/v1/globals',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'name' => 'News-Report',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`POST api/v1/globals`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Name of the Global word.
    
<!-- END_f63780d889b0eaa1108bbb4632c51044 -->

<!-- START_eea54fc99f78368119f3fc977cda02b1 -->
## Delete Global Keyword

Use this api to Delete specific Global Keyword.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete('http://scma-api.test/api/v1/globals/1');
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/v1/globals/{global}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The id of the specific Global Keyword.

<!-- END_eea54fc99f78368119f3fc977cda02b1 -->

<!-- START_6f473de6dbdce6689b89bb70f54b1935 -->
## Update Global Keyword
Update the specified  Global Keyword in storage.

Use this api to Update  Global Keyword.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://scma-api.test/api/v1/globals/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'name' => 'dubai-traffic',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`PUT api/v1/globals/{keyword}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | int required Id of the global keyword.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | Name of the global keyword.
    
<!-- END_6f473de6dbdce6689b89bb70f54b1935 -->

#Site


<!-- START_acea4e77358b9adfc2985b52e64d7c0e -->
## Fetch Sites

This endpoint retrieves all sites along with categories

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://scma-api.test/api/v1/sites',
    [
        'query' => [
            'total'=> '2',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "url": "https:\/\/www.oliverwyman.com\/media-center.html",
            "name": "Oliver Wyman Media Release",
            "crawl": "active",
            "depth": 1,
            "interval": 30,
            "site_color": "#0000a8",
            "site_type": "normal",
            "site_selector": "class",
            "selector_value": "eight--columns",
            "categories": [
                {
                    "category_id": 1,
                    "name": "Fire Control Management",
                    "site_id": 1
                },
                {
                    "category_id": 2,
                    "name": "Emergency Services",
                    "site_id": 1
                },
                {
                    "category_id": 5,
                    "name": "Public Services",
                    "site_id": 1
                },
                {
                    "category_id": 6,
                    "name": "Human Resources",
                    "site_id": 1
                }
            ]
        }
    ]
}
```

### HTTP Request
`GET api/v1/sites`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | Specific site you want to retrieve by id.
    `name` |  optional  | Search by site name
    `depth` |  optional  | Search by crawl depth of site
    `total` |  optional  | Number of sites you want to retrieve. Defaults to 20.

<!-- END_acea4e77358b9adfc2985b52e64d7c0e -->

<!-- START_f3c4cfd076c7d491e1373000d9975051 -->
## Add Site

This endpoint use to create a Site

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://scma-api.test/api/v1/sites',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'url' => 'https://www.google.com/',
            'name' => 'News-Report',
            'crawl' => 'active|inactive',
            'site_color' => '#ff0000',
            'site_type' => 'normal',
            'interval' => 18,
            'depth' => 2,
            'site_selector' => 'tag',
            'selector_value' => 'article',
            'categories' => [
                [
                    'category_id' => '1',
                ],
                [
                    'category_id' => '2',
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`POST api/v1/sites`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `url` | url |  required  | url of the site.
        `name` | string |  required  | name of the site.
        `crawl` | string |  required  | Crawl Status of Site.
        `site_color` | string |  required  | This should be hex code of color for site Exp: #000, #ff0000, #d41bd4.
        `site_type` | string |  required  | define type of site either (rss) or (normal) Exp: rss, normal.
        `interval` | integer |  required  | add crawl interval in minutes
        `depth` | integer |  optional  | add crawl depth 1 (Glance), 2 (Moderate), 3 (Deep).
        `site_selector` | string |  optional  | define selector type Exp: class, id, tag.
        `selector_value` | string |  optional  | define selector value which site use to contain their posts.
        `categories[0][category_id]` | array |  optional  | Associate any category to site by category_id.
        `categories[1][category_id]` | array |  optional  | Associate any category to site by category_id.
    
<!-- END_f3c4cfd076c7d491e1373000d9975051 -->

<!-- START_5da3af38c749e691e3c54dc0e2b0112f -->
## update Site

This endpoint use to update a Site

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://scma-api.test/api/v1/sites/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'url' => 'https://www.google.com/',
            'name' => 'News-Report',
            'crawl' => 'active|inactive',
            'site_color' => '#ff0000',
            'site_type' => 'normal',
            'interval' => 7,
            'depth' => 2,
            'site_selector' => 'tag',
            'selector_value' => 'article',
            'categories' => [
                [
                    'category_id' => '1',
                ],
                [
                    'category_id' => '2',
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`PUT api/v1/sites/{site}`

`PATCH api/v1/sites/{site}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `url` | url |  required  | url of the site.
        `name` | string |  required  | name of the site.
        `crawl` | string |  required  | Crawl Status of Site.
        `site_color` | string |  required  | This should be hex code of color for site Exp: #000, #ff0000, #d41bd4.
        `site_type` | string |  required  | define type of site either (rss) or (normal) Exp: rss, normal.
        `interval` | integer |  required  | add crawl interval in minutes
        `depth` | integer |  optional  | add crawl depth 1 (Glance), 2 (Moderate), 3 (Deep).
        `site_selector` | string |  optional  | define selector type Exp: class, id, tag.
        `selector_value` | string |  optional  | define selector value which site use to contain their posts.
        `categories[0][category_id]` | array |  optional  | Associate any category to site by category_id.
        `categories[1][category_id]` | array |  optional  | Associate any category to site by category_id.
    
<!-- END_5da3af38c749e691e3c54dc0e2b0112f -->

<!-- START_2e52dd08962a9ba770f583401a7a71aa -->
## Delete Event

Use this api to Delete specific Event.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete('http://scma-api.test/api/v1/sites/1');
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/v1/sites/{site}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The id of the specific Event.

<!-- END_2e52dd08962a9ba770f583401a7a71aa -->


