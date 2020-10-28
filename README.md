# Contributing / Installation

1. Run `git clone https://github.com/Jose4fun/CAP2100-System.git`
2. Run these commands in order within the CAP2100-System folder  
   a. `composer install`  
   b. `copy .env.example .env`  
   c. `php artisan key:generate`  
   d. `php artisan make:database` (After turning on the MySQL server)  
   e. `php artisan migrate`

# Code Formatting

This project uses [php-cs-fixer](https://github.com/FriendsOfPhp/PHP-CS-Fixer) tool and a community maintained ruleset to format the project files.

There are two commands involved:

1. To check the formatting without fixing the code style, use `composer check-style`
2. To fix the code style, use `composer fix-style`

It is advised to fix the code style before committing

# Recommended Visual Studio Code Plugins

Here are a few recommended plugins for the development of this plugin using [Visual Studio Code](https://code.visualstudio.com/).

1. [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client) for PHP code intelligence
2. [Auto Close Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-close-tag) to automatically add HTML/XML close tag
3. [Auto Rename Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-rename-tag) to automatically rename paired HTML/XML tag
4. [Bracket Pair Colorizer 2](https://marketplace.visualstudio.com/items?itemName=CoenraadS.bracket-pair-colorizer-2) to identify matching brackets with colours
5. [GitLens](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens) to integrate enhanced Git capabilites into Visual Studio Code
6. [HTML CSS Support](https://marketplace.visualstudio.com/items?itemName=ecmel.vscode-html-css) for CSS class and id completion
7. [Laravel Artisan](https://marketplace.visualstudio.com/items?itemName=ryannaddy.laravel-artisan) to run Laravel Artisan commands from within Visual Studio Code
8. [Laravel Blade Snippets](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade) to provide Laravel Blade snippets and support Blade syntax highlighting
9. [Laravel Snippets](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel5-snippets) to provide Laravel snippets
10. [Laravel goto view](https://marketplace.visualstudio.com/items?itemName=codingyu.laravel-goto-view) to allow quick jump to Laravel views file
11. [laravel-goto-controller](https://marketplace.visualstudio.com/items?itemName=codingyu.laravel-goto-view) to allow quick jump from Laravel route to controller file
12. [Live Share](https://marketplace.visualstudio.com/items?itemName=MS-vsliveshare.vsliveshare) to allow collaborative editing (Mainly used to view other's code and discuss on code before committing)
13. [Prettier - Code formatter](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode) provide code formatting for HTML, CSS and Javascript
