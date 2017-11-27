# Link-Sling

## MVP

SMS backed free website that will send weblinks/messages to numbers on all mobile networks with 3 criteria being met:

* Link/message
* Phone number to send to
* User info for who it was sent from

## User Stories

1) No login, no account, free. Be able to send a web link or message via SMS to anyone by only entering the above 3 criteria.

2) User account that can save contact info, send group messages/links, and use API to log in w/ Google+, Facebook, etc.

3) School/Company use to send links/messages to specific groups set up by the individual user or set up by company/school w/ permissions to certain users.

## Stretch Goals

* Serve adds that conform to the Acceptable Adds program and the EFF Do Not Track privacy standard.
* Message history will show whether message was received.
* O-Auth (give it half a day).

## Additional Reqs

* Everything behind Authorization with a Captcha (look into Captcha for at least half a day).
* Authorization from receiver end to avoid abuse.
* Message history with timestamps, message contents.
* Can save contat list.