### Tutorial
The application is made on the principle of scalable architecture.
The main hierarchy is the MODULES and the APPLICATION. 
The modules has not related to each other. 
Communication with the application is provided by the composition ..
At the application level, I tried to use minimal db relationships, because I believe that use of links entails an additional load on the application, it's more convenient to use entities atomically rather than combining them.

Tests I did not do - I give this wonderful opportunity to you.

**No frameworks were used.** 
"MVC Application" and "Dependency" were implemented by the native PHP 7.1 with the most topical changes.
I saw that others did the registration, but I did not want to, because it would take additional time, 
and even more so in the task is not specified.

### Requirements

    PHP !<7.1
    NPM (latest)
    MySQL !< 5.5
    Composer
    
### Installation

Clone app into root directory and run

```
npm install
npm start
```

Create a database **`quiz`** and in any convenient way upload src from
/docs/quiz.sql
/docs/ERR.pdf - for review tables rel


```
// for MySQL config (my defaults)
// host     : localhost
// database : quiz
// username : root
// password : root
src/Quiz/Modules/Question/config/module.config.php
```


**KISS**

Many thanks to @nezllayaya for helps with Bootstrap CSS!

**Summary estimated : 25 working hours**