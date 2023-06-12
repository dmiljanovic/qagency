* This mini project is a response to the task.

# General tips and trick:
* Create a new Symfony, Laravel or “vanilla” PHP project, push it to Github/Bitbucket/Gitlab
repository and when the assignment is done send us a link or an invite to the repository
* feel free to ignore the frontend part - don't spend your time on CSS and styling, functionality is
the most important part. Naked HTML is fine too! :-)
* setup of the project must be as simple as possible - i.e. iit is enough to use Symfony/PHP built
in web server
○ document the setup process - the simpler the better
* if you have further questions or are unsure about something - send us an email, and we’ll either
answer your questions or give you a hint/nudge in the right direction
* PHP 7.4 is minimum, and if you can do it with 8.0+ - go right ahead!
* minimal validation is enough, don't waste too much time on it - if the request passes, it's ok!

# Client
* create a client for connection on Q Symfony Skeleton API (QSS)
** swagger documentation: https://symfony-skeleton.q-tests.com/docs

* create a login page that uses Q Symfony Skeleton API, retrieve access token
* store the token using any storage you want (Session, Cookie, something more creative? (Up to
you!), with any expiration time (use common sense, 10 seconds is a bad expiration time! :))

# Authors
* fetch the list of Authors from the API, display them in a table layout
* enable a user to delete the author if there's no related books for this author
* Create a view page of single authors and their books
* Extra Bonus Part: Symfony CLI command to add a new author using the Q Symfony Skeleton
API - this is just for extra points, if you have time ;-) It won’t make you look bad if you show
excellent dev skills, but decide to skip this one

# Instruction to install

* Clone repo

* From your console at your root folder execute 'composer install' to install dependencies.

* From your console at your root folder execute 'php artisan key:generate' to generate and set APP_KEY

* For creating new author from your console at your root folder execute 'php artisan create:author' and folow instruction
