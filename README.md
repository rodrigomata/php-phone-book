# PHP Phone book
This is a sample CRUD PHP Phone Book.

## Requirements
- Docker

## Installation
1. Docker
Install [Docker](https://www.docker.com/).

2. Update hosts file if needed
Update your `/etc/hosts` file in case the *localhost* entry is not added like so:
```sh
127.0.0.1   localhost
```

3. Run docker 
Navigate to the root folder of this project and run `docker-compose up`. This will pull the required images from docker and run them on the background.

4. Open browser
Navigate to [http://localhost:8080/](http://localhost:8080/).

## How to access the database
From the terminal, run the following command `docker exec -it mysql-db mysql -u root -p`.
Root password (defined inside `/docker/mysql/Dockerfile`): test

### How to get database IP
To get the IP of the container (for connecting remotely, like MySQL Workbench) run the following command: 
```
`docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mysql-db`
```

### Connect locally to docker container
Connection with e.g. MySQL Workbench:
- **Hostname**: 0.0.0.0 
- **Port**: 42333

## Usage
Follow [REST conventions](https://en.wikipedia.org/wiki/Representational_state_transfer) to get information from the API.

For example, if you want to get a list of the users, use the HTTP GET METHOD, along with the `user` resource:
```sh
GET /api/user
```

Test: [http://localhost:8080/api/user](http://localhost:8080/api/user)

The API will always return a json with both `data` and `message` properties. In case an error occurs, `message` will be different than 'OK'.
