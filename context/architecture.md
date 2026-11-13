# Architecture Guidelines

## Core Philosophy: Simplicity & Serviceability
- **Target Complexity Level**: Beginner to Intermediate.
- **Purpose**: This project enhances a foundational Laravel CRUD tutorial into a clean, serviceable portfolio piece and future reference implementation.
- **Out-of-the-Box Laravel MVC**:
  - Stick to standard, idiomatic Laravel conventions (**Routes → Controllers → Models → Blade Views**).
  - Avoid unnecessary architectural abstractions (such as Repository patterns, DTOs, Action classes, Service layers, or Event-driven pipelines) unless explicitly requested.
  - Favor explicit, self-explanatory logic that is easy to read, trace, and revisit in the future.
- **Frontend Structure**:
  - Server-rendered Blade templates sharing a common layout (`Header` + `Main Content` + `Footer`).
  - Modular vanilla CSS files organized by feature/block and strictly following BEM naming conventions.
