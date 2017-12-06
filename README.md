
<img src="https://github.com/joncgrubb/link-sling/raw/master/docs/Link-Sling-Logo.png" width="50%" height="50%" margin="auto">

Link-Sling is an application that utilizes the Twilio API to send text messages and web links from browser to mobile.

You can manage a Contacts list by adding, editing and deleting Contacts. A message History is also included that will show the receiver, message contents, date and status for each message. The app handles all incoming SMS and voice calls and instructs users how to interact with the app from mobile.

Link-Sling utilizes the Laravel PHP framework and a PostgreSQL object-relational database. The live version of Link-Sling is hosted as a Hobby provisioned Heroku application.

## Usage

First, clone this repo:

`git clone https://github.com/joncgrubb/link-sling.git`

Install dependencies:

`npm install`

`composer install`

Set up your local PostgreSQL database. Head on over to [PostgreSQL](https://www.postgresql.org/) if you need help installing and setting it up.

Start by creating a new database and user:

`psql`

`CREATE USER username WITH PASSWORD 'password';`

`CREATE DATABSE dbname OWNER username;`

`\quit`

Create your local ENV file then copy/paste the contents of the supplied .env.example into it:

`touch .env`

Now you will need to set up a few free accounts with the services required for this app to work:

[Twilio](https://www.twilio.com/)

[Google reCaptcha](https://www.google.com/recaptcha/intro/)

You will also need to download and unzip an awesome little tunneling tool, feel free to add a global alias to this guy:

[ngrok](https://ngrok.com/download)



---

Jonathan Grubb - 2017