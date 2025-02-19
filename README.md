
# Jenkins-PHP-MySQL-App

This project demonstrates the deployment of a PHP web application with a MySQL database using Docker and Jenkins for CI/CD. The setup includes:
- **Docker Compose** for container orchestration.
- **Jenkins** for Continuous Integration and Continuous Deployment.
- **PHP** application served via Nginx.
- **MySQL** as the database.
- **NGINX** as webserver

---

## Project Structure
```
├── compose.yml         # Docker Compose configuration
├── Dockerfile          # Docker image definition for the PHP application
├── Jenkinsfile         # CI/CD pipeline definition for Jenkins
└── web-server
    ├── default         # Nginx configuration file
    └── index.php       # Main PHP application file
```

---

## Prerequisites

Make sure you have the following installed on your system:
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Jenkins](https://www.jenkins.io/doc/book/installing/)

---

## Getting Started

1. **Clone the Repository**:
   ```sh
   git clone https://github.com/your-username/jenkins-php-mysql-app.git
   cd jenkins-php-mysql-app
   ```

2. **Access the Application**:
   - Open your browser and navigate to: `http://localhost:7799`

---

## CI/CD Pipeline with Jenkins

The `Jenkinsfile` defines the CI/CD pipeline stages:
- **Checkout**: pull the repo into the jenkins work space.
- **Build Docker Image and push**: build the docker images based on the app and push it to docekrhub.
- **Deploy**: Deploys the containers using docker compose .

### Setting up Jenkins

1. Access Jenkins at `http://localhost:8080`.
2. Create a new pipeline job.
3. Point the pipeline to this repository's `Jenkinsfile`.
4. Run the pipeline to see the CI/CD in action.

---

## Application Details

- **Web Server**: Nginx
- **Programming Language**: PHP
- **Database**: MySQL

### Default Nginx Configuration:
The Nginx configuration is stored in `web-server/default`.

### Example PHP Code:
`index.php` is a simple PHP file to verify the setup that counts number of people visted

---

## Customization

- **Update Nginx Config**:
  Modify `web-server/default` as needed.
- **Modify PHP Code**:
  Update `index.php` for your application logic.
- **Change MySQL Credentials**:
  Edit the `compose.yml` file to set custom database credentials.

---


## Contributing

Feel free to contribute by opening issues or submitting pull requests.

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Author

- **[Belal Elnady](https://github.com/belalelnady)**

---

## Acknowledgments

- [Docker](https://www.docker.com/)
- [Jenkins](https://www.jenkins.io/)
- [PHP](https://www.php.net/)
- [Nginx](https://www.nginx.com/)

---

Feel free to customize this as needed, especially the sections related to configuration, deployment, and your personal information.
