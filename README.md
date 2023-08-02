## Author's comments :)

Hey guys! Test assignment was great ) I really enjoyed solving it :)
Though given time surely not enough to build it ideally )

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
