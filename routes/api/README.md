# API Documentation

This document provides a detailed overview of the available API endpoints, their functionalities, and how to use them.

## Estados

### GET /api/estados

-   **Description:** Retrieves a list of all states.
-   **Response:**
    -   `200 OK`: A JSON array of state objects.

### GET /api/estados/{uf}

-   **Description:** Retrieves information for a specific state.
-   **Parameters:**
    -   `uf` (string, required): The two-letter abbreviation of the state (e.g., `SP`).
-   **Response:**
    -   `200 OK`: A JSON object representing the state.
    -   `404 Not Found`: If the state is not found.

## Iniciativas

### GET /api/iniciativas

-   **Description:** Retrieves a list of all initiatives.
-   **Query Parameters:**
    -   `tipo` (string, optional): Filters initiatives by type (e.g., `água`, `ecologia`).
    -   `status` (string, optional): Filters initiatives by status (e.g., `em_andamento`, `concluído`).
    -   `data_inicio` (date, optional): Filters initiatives by start date (e.g., `2023-01-01`).
    -   `data_fim` (date, optional): Filters initiatives by end date (e.g., `2023-12-31`).
-   **Response:**
    -   `200 OK`: A JSON array of initiative objects.

### GET /api/iniciativas/search

-   **Description:** Searches for initiatives based on a query string.
-   **Query Parameters:**
    -   `q` (string, required): The search term.
-   **Response:**
    -   `200 OK`: A JSON array of initiative objects that match the search term.

### GET /api/estados/{uf}/iniciativas

-   **Description:** Retrieves all initiatives for a specific state.
-   **Parameters:**
    -   `uf` (string, required): The two-letter abbreviation of the state.
-   **Query Parameters:**
    -   `tipo` (string, optional): Filters initiatives by type (e.g., `água`, `ecologia`).
    -   `status` (string, optional): Filters initiatives by status (e.g., `em_andamento`, `concluído`).
    -   `data_inicio` (date, optional): Filters initiatives by start date (e.g., `2023-01-01`).
    -   `data_fim` (date, optional): Filters initiatives by end date (e.g., `2023-12-31`).
-   **Response:**
    -   `200 OK`: A JSON array of initiative objects.
    -   `404 Not Found`: If the state is not found.

## Estatísticas

### GET /api/estatisticas

-   **Description:** Retrieves aggregated data about the initiatives.
-   **Response:**
    -   `200 OK`: A JSON object containing the following keys:
        -   `total_por_regiao`: An array of objects with `regiao` and `total` keys.
        -   `investimento_total`: The sum of all investments.
        -   `distribuicao_por_tipo`: An array of objects with `tipo` and `total` keys.
