#New Media Design & Development II


```
munch.local/
├── www/        # Laravel App
└── README.md
```

##Beschrijving
Backoffice voor een webshop voor het verkopen van verse ingrediënten in Laravel.

##Auteur
Matthias Seghers  
[Github](http://github.com/mattsegh1/) 
[Bitbucket](http://bitbucket.com/mattsegh1/)  
**Email:** [matthias.seghers1@student.arteveldehs.be](mailto:matthias.seghers1@student.arteveldehs.be)  

##Benodigdheden

* [Artestead][artestead-dl]  
* [Vagrant][vagrant-dl]  

##Databasestructuur
![Database Model][Dbmodel]

##Installatie

### Project installeren

```
$ c
$ git clone https://github.com/mattsegh1/munch.local
$ munch
$ artestead make --type laravel --ip 192.162.10.20
$ composer update
```

### Server starten

```
$ vagrant up
```

### Backoffice en API (Laravel App)
_In de root van de projectmap._

```
$ vss
vagrant@munch$ composer_update
vagrant@munch$ munch && cd www/
vagrant@munch$ composer create-project
vagrant@munch$ composer update
vagrant@munch$ artisan munch:database:user
vagrant@munch$ artisan munch:database:init --seed
vagrant@munch$ exit
$ _
```


URI's
-----

 - <http://www.munch.local>
 - <https://www.munch.local>

[artestead-dl]: http://www.gdm.gent/artestead/
[vagrant-dl]: http://www.vagrantup.com/
[Dbmodel]: https://i.imgur.com/aTVjT7M.png