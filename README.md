<div align="center">
  <h3 align="center">A Simple Kanban Board Made with Laravel And VueJs</h3>
  <p align="center">
    Welcome to the README, you will be shown how to quick start the project.
  </p>
    <br />
</div>

<!-- TABLE OF CONTENTS -->

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installations">Installation</a></li>
      </ul>
    </li>
    <li><a href="#Used-Tools">Used Tools</a></li>
    <li><a href="#Challenge-Description">Challenge Description</a></li>
    <li><a href="#Contact">Contact Me</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

A Kanban board is a visual tool used to manage and organize work in a process. It typically consists of columns that represent different stages of a workflow, such as "To Do," "In Progress," and "Completed." Work items, such as tasks or projects, are represented by cards that are moved from left to right across the board as they progress through the workflow. The Kanban method helps to limit work in progress, visualize the flow of work, and make process policies explicit. It also provides a simple way for teams to collaborate, prioritize tasks, and track progress, making it a popular tool for managing and improving workflow in software development, manufacturing, and other industries.

The Challenge:

-   Design the API in a way that a frontend application could consume it.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

This simple project was built with the Laravel framework and used RESTApi for the backend, as for the front-end VueJs was used.

-   [Laravel][laravel-url]
-   [Vue][vuejs-url]

<!-- GETTING STARTED -->

## Getting Started

### Prerequisites

At first you will need to clone the git repository to your local machine, so you need to run:

```sh
 git clone https://github.com/BadrChoujai/kanban-board.git
```

### Local Usage

- As for running the app on your local machine, i have used laravel valet.

## Authentication

The app does not not use any sort of authentication, as it was not needed.

## Columns

To retrieve the list of columns with their cards:

-   Request `GET` |`/columns`

-   with Response

    ```json
    "data": [
        {
            "id": 1,
            "title": "Doing",
            "created_at": "2023-01-14T12:37:40.000000Z",
            "updated_at": "2023-01-14T12:37:40.000000Z",
            "deleted_at": null,
            "cards": [
                {
                    "id": 13,
                    "title": "cool",
                    "description": "soo",
                    "column_id": 1,
                    "created_at": "2023-01-14T13:51:42.000000Z",
                    "updated_at": "2023-01-14T13:51:55.000000Z",
                    "deleted_at": null
                },
            ...
          ...
        }
    ]

    ```
    
## Column Cards

To retrieve list of cards for specific column:

-   Request `GET` | `/columns/cards` | column "id" as a payload

-   Response

    ```json
        {
        "data": [
            {
                "id": 1,
                "title": "New Challenge todo",
                "description": "starting monday:)",
                "column_id": 3,
                "created_at": "2023-01-14T12:38:07.000000Z",
                "updated_at": "2023-01-14T13:51:55.000000Z",
                "deleted_at": null
            },
                ...
         ],
       }
    ```

## List Cards

To retrieve list of cards with filters:

-   Request `GET` | `/list-cards`

-   Params and Filters requested:

    - Creation date: format YYYY-MM-DD. If empty, bring all creation dates. 
    - Status: value 1 for active,and 0 for deleted cards.If equals to 'all',

-   Response

    ```json
        {
        "data": [
            {
                "id": 1,
                "title": "Doing good",
                "description": "start doing good allright",
                "column_id": 2,
                "created_at": "2023-01-14T12:38:07.000000Z",
                "updated_at": "2023-01-14T13:51:55.000000Z",
                "deleted_at": null
            },
                ...
         ],
       }
    ```

### Columns Storing

Save Columns:

-   Request `POST` | `/columns/storeColumns`

-   Params as JSON

    ```json
        "data":[
           {
                "id": 6,
                "title": "New stuff",
                "created_at": "2023-01-14T14:22:56.000000Z",
                "updated_at": "2023-01-14T14:22:56.000000Z",
                "deleted_at": null,
                "cards": []
           }
        ]
    ```

-   with Response if successfull

    **200 status code**

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Used Tools

-   Used **Postman** To Test RESTApi endpoints.
-   Used **Sequel Ace** as a database manager.

## Challenge Description

-  A Kanbanboard similarto Trello (https://trello.com) board but simplified.

<!-- CONTACT -->

## Contact

Badr CHOUJAI - [linkedin-url] - choujai.badr@gmail.com

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/choujai-badr
[laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[laravel-url]: https://laravel.com
[vuejs-url]: https://vuejs.org
