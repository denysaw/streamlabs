## Streamlabs FullStack Assignment

Thank you for choosing to invest your time in this assignment.  We recognize it’s difficult to find the time to complete a coding assignment, and we value your time and investment in this process with us.

## Stack
At Streamlabs we mainly make use of PHP, Laravel, Vue, React, TypeScript, MySQL. Please make use of Laravel & PHP for this assignment so we know you are familiar with our backend stack.

## Application: Stream Events
You will build an application called “Stream Events”. This application is aimed at showing streamers a list of events that happened during their stream.

## Registration:
Users should be able to create an account through your preferred oauth login system, this can be anything from Twitch, Youtube, Facebook, etc..

## Assignment Requirements:
Create the following tables:
followers (name)
subscribers (name + subscription tier 1/2/3)
donations (amount + currency + donation message)
merch_sales (item name + amount + price)
Seed each table with about 300-500 rows of data for each user with creation dates ranging from 3 months ago till now
Each of these rows should be able to be marked as read / unread by the user
Aggregate the data from the above three tables
Show it to the user once they log in
Use a single list to display this information, format it as a sentence
RandomUser1 followed you!
RandomUser2 (Tier1) subscribed to you!
RandomUser3 donated 50 USD to you!
“Thank you for being awesome”
RandomUser4 bought some fancy pants from you for 30 USD!
Only show the first 100 events
Load more as they scroll down
Above the list show three squares with the following information
Total revenue they made in the past 30 days from Donations, Subscriptions & Merch sales
Subscriptions are Tier1: 5$ , Tier2: 10$, Tier3: 15$
Total amount of followers they have gained in the past 30 days
Top 3 items that did the best sales wise in the past 30 days

## Extra Notes:
Please make use of best practices as if you were working on a large scale project

## Frontend
Build a simple SPA (Single Page Application) using Javascript & CSS, this does not have to look pretty. The main focus of this assignment is the Backend implementation. Be sure to use REST API calls from the frontend side to call the backend.

## Deliverables
This is a take-home assignment and please do not spend more than 4 hours on the project, these 4 hours do not include the time it takes you to setup your dev environment.
You can submit a partial project if it’s not completed by the end of the 4 hour period.

The code is to be published on a public github repository for our team to access. Make sure that we can see your progress in your commit history, a single commit is not enough.

In order to demo the application you can either submit a short video showing us the entire flow and the results or you can host it anywhere on the web for us to access it.

## Author's comments :)

Hey guys! Test assignment was great ) I really enjoyed solving it :)
Though given time surely not enough to build it ideally )
I was unable to implement a front-end part in time.

Here's the demo video: https://drive.google.com/file/d/14BDxcFmNNnLAQGFQ62Vsj64ww_RONnM1/view?usp=sharing

I wasn't sure if Followers/Subscribers/Donators/Buyers should be a real User entities from the same `users` table (as it was mentioned that each or another table should have only `name` field and not the foreign `user_id`), so I created just an abstract tables/entities with a "connection" only to mine seeded user.

Surely, ideal solution for solving read/unread events problem, would be in creating onInsert DB trigger for each of those tables with adding a row to a separate `events` table or event-based app model. But as the phrase "Aggregate the data from the above three tables" was used, I made it view aggregation into a concurrently cron-refreshable materialized view.

If I have more time (or work on this project), next steps would be:
- Implement front-end in Vue3
- Add redis caching to the aggregational http requests
- Covering everything with Unit and Integration tests (I do love TDD, but that would steel my time from the actual assignment :)
- Adding CSRF token check
- Adding Swagger OpenAPI endpoint
- Dockerization
- Scaling with Octane
- Deploying with RoadRunner Sail/Swolle/Vapor and whitelistening my subdomain in FB/Google App settings
- Setting up Horizon for the monitoring
