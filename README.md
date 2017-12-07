
<img src="https://github.com/joncgrubb/link-sling/raw/master/docs/Link-Sling-Logo.png" width="50%" height="50%" margin="auto">

Link-Sling is an application that utilizes the Twilio API to send text messages and web links from browser to mobile.

You can manage a Contacts list by adding, editing and deleting Contacts. A message History is also included that will show the receiver, message contents, date and status for each message. The app handles all incoming SMS and voice calls and instructs users how to interact with the app from mobile.

Link-Sling utilizes the Laravel PHP framework and a PostgreSQL object-relational database. The live version of Link-Sling is hosted as a Hobby provisioned Heroku application.

## Usage

First, clone this repo:

$ `git clone https://github.com/joncgrubb/link-sling.git`

Install dependencies:

$ `npm install`

$ `composer install`

Set up your local PostgreSQL database. Head on over to [PostgreSQL](https://www.postgresql.org/) if you need help installing and setting it up. Start by creating a new database and user:

$ `psql`

$ `CREATE USER username WITH PASSWORD 'password';`

$ `CREATE DATABSE dbname OWNER username;`

$ `\quit`

Create your local ENV file then copy/paste the contents of the supplied .env.example into it:

$ `touch .env`

Now you will need to set up a few free accounts with the services required for this app to work:

[Twilio](https://www.twilio.com/)

[Google reCaptcha](https://www.google.com/recaptcha/intro/)

You will also need to download and unzip an awesome little tunneling tool, feel free to add a global alias to this guy:

[ngrok](https://ngrok.com/download)

Run your Laravel migrations now to get your database ready for the app:

$ `php artisan migrate`

Now you can let ngrok (pronounced 'en-grok' as per Alan, the author) open a tunnel for your local server to speak to the outside world, that is the whole point of Link-Sling, afterall:

$ `./ngrok http 8000`

You can now open a browser tab to localhost:4040 an utilize the ngrok web interface to inspect the Twilio API traffic you'll be having shortly.

Reopen your .env file, we need to populate those dummy fields with your newly acquired Twilio and Google reCaptcha information.

First, navigate to your project's [Twilio Settings](https://www.twilio.com/console/project/settings) page and copy the Account SID and Auth Token into the appropriate fields in your ENV. If you haven't already, follow the instructions available from your Twilio Dashboard and copy your Twilio Phone Number over as well. (Note it will need to read exactly as it shows, for example: +15552225555, the +1 prefix must be there in your ENV)

Next are the Google reCaptcha fields in the .env. Navigate to your new reCaptcha account page and copy the Site Key and Secret Key into their respective ENV fields.

Now serve your local version of Link-Sling. If you plan on tinkering with styling, functionality or anything else then utilize the built in webpack browser refresh. I typically use 2 Terminal tabs for this just to make my life easier, in one:

$ `php artisan serve`

In the other:

$ `npm run watch`

(Note you will likely need to run this second command twice, as BrowserSync will need to build and install require dependencies first. Don't sweat if it fails, just run the command a second time.)

## Like the App?

This was my final project for my 12 week Web Development Bootcamp at [Awesome Inc University](https://www.awesomeincu.com/) and I only had a week and half to make this happen. There is plenty left to do and new features to implement. If you'd like to get in touch my contact info is available at [my homepage](http://www.joncgrubb.com/#/)

---

Jonathan Grubb - 2017