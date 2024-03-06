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
- Requirements
  - Docker (Docker Desktop preferred)

- Steps to get running
  - `$ some command todo`

## Explanation
### Framework
I chose the PHP Laravel framework due to my experience with it and its simplicity for rapid prototyping. Sail - Laravel's default docker env - makes getting started a breeze. 

This might be a little heavy for such small requirements, and I could whip up a "simpler" POC with something like node/express, but this works and sets up a potential future for the app.
