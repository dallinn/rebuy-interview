# Pomodoro - Rebuy Interview

## Requirements

- API Endpoints: Design a RESTful API for:
  - Updating user settings (default timer lengths)
  - Starting/stopping Pomodoro sessions
  - Storing completed session data (with timestamps, optional task descriptions)
  - Retrieving session history for analysis

- Database Design:
  - Choose a suitable database (MySQL, PostgreSQL, etc.).
  - Create appropriate schemas to store user data, settings, and session history.

- Stretch Goals (Optional)
  - Real-time Updates: Use WebSockets or similar technology for instant updates to the frontend when sessions change on the backend.
  - Advanced Analytics: Calculate productivity metrics over time, or provide tools for users to visualize their work patterns.
  - Team Features: If ambitious, explore multi-user functionality where teams can track progress together.

## Technical Considerations

- PHP Framework: The choice is yours (Laravel, Symfony, etc.). Explain your preference.
- Database: Design normalized schemas, consider indexing for performance.
- API Design: Document API endpoints, expected request/response formats. Security (authentication/authorization) is key here!
- Testing: Outline strategies to unit test API endpoints and data handling.


## Deliverables

- Backend Code: Well-structured code with comments explaining key logic.
- API Documentation: Clear description of endpoints, parameters, and data models.
- Setup Guide: How to run the backend locally, database setup.
- Design Overview: Explain schema choices, framework decisions, security considerations.

## Goals
- We want to evaluate a developer's:
  - Backend Architecture: How do they design APIs, structure data, and prioritize security?
  - Database Skills: Do they design efficient schemas and understand optimization?
  - Problem-Solving: How do they tackle timer state management and handle potential concurrency issues?
  - Beyond the Basics: Do they demonstrate forward-thinking with real-time features or thoughtful analysis tools?

# My Solution

## Quick start
### Requirements
- Docker (Docker Desktop preferred)
- `Sail` aliased in zshrc / bash_profile / bashrc
  - If not, then run `./vendor/bin/sail` instead of `sail`

### Steps to get running
1) Start the server: `sail up`
    - If you do not have docker running, `php artisan serve`, but this is untested.
    - If you did not alias `sail` as explained above this will fail.
2) Run tests: `sail artisan test`

## Explanation
### Framework
I chose the PHP Laravel framework due to my experience with it and its simplicity for rapid prototyping. Sail - Laravel's default docker env - makes getting started a breeze. 

Laravel includes a LOT of boilerplate. Which is nice for POCs but for this case might be a little heavy. I could whip up a "simpler" POC with something like node/express, but this works and sets up a potential future for the app.

### Authentication
Sanctum - Again, Laravel has many packages that make rapid prototyping easy. 

Sanctum vs Passport: Since we are only doing an API and I'm not going to roll out my own Oauth2 for this (nor use Google/Facebook/etc aka "federated") I decieded to use the lighter Sanctum for token-based auth.

### Timer
I thought about using laravel's event & queing system to actually implement the timer, ie start session for 25 seconds, wait, then update to done, but I wouldn't do that in real life so I opted to use the excuse "the frontend will handle it."


### Sample Commands
I could have used Swagger to make this easier and all my microservices at my current position have that, but for simplicity sake here are curl commands:


#### Signup
```
curl -X POST http://localhost/api/signup \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d '{"name": "Some Name", "email": "test@test.com", "password": "password123", "password_confirmation": "password123"}'
```

#### Login 
```
curl -X POST http://localhost/api/login \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d '{"email": "test@test.com", "password": "password123"}'
```

#### Create Pomodoro Session
```
curl -X POST http://localhost/api/sessions/start \
    -H "Accept: application/json" \
    -H "Authorization: Bearer [token_from_signup_or_login]" \
    -H "Content-Type: application/json" \
    -d '{"description": "My Pomodoro Session"}'
```

#### Stop Pomodoro Session
```
curl -X POST http://localhost/api/sessions/stop \
    -H "Accept: application/json" \
    -H "Authorization: Bearer [token_from_signup_or_login]" \
    -H "Content-Type: application/json" \
    -d '{"session_id": 1}'
```

#### Update User Settings
```
curl -X PUT http://localhost/api/settings \
    -H "Accept: application/json" \
    -H "Authorization: Bearer [token_from_signup_or_login]" \
    -H "Content-Type: application/json" \
    -d '{"duration": 25}'
```