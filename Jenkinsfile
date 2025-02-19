pipeline {
    agent none
    environment {
        IMAGE_NAME = 'belalelnady/php-mysql-views-counter:latest'
        REMOTE_HOST = '192.168.1.111'
        HOST_NAME = 'belal'
        GIT_URL = 'https://github.com/belalelnady/jenkins-php-mysql-app'
    }
    stages {
        stage('Checkout') {
            agent {label 'ssh-agent'}
            steps {
                // cant use `checkout scm` cuz it will be executed in  every stage 
                git url: ${GIT_URL}, branch: 'master'
              
            }
        }
        
        stage('Build Docker Image and push') {
            agent {label 'jenkins-agent-with-docker'}
            steps {
               
                 withCredentials([usernamePassword(credentialsId: 'dockerHub', 
                                                  usernameVariable: 'DOCKER_USER', 
                                                  passwordVariable: 'DOCKER_PASS')]) {
                    script {

                        docker.build("${IMAGE_NAME}", '.')
                        sh """
                            docker login -u ${DOCKER_USER} -p ${DOCKER_PASS}
                            docker push ${IMAGE_NAME}
                        """
                    }
                }
            }
        }
        
        stage('Compose up') {
            agent {label 'ssh-agent'}
            steps {
                sshagent (credentials: ['u-server']) {

                     sh """
                        mkdir -p ~/.ssh
                        #Remove the key if existed
                        ssh-keygen -R ${REMOTE_HOST} 2>/dev/null || true
                        ssh-keyscan -H ${REMOTE_HOST} >> ~/.ssh/known_hosts
                        chmod 600 ~/.ssh/known_hosts

                        scp  compose.yml ${HOST_NAME}@${REMOTE_HOST}:/home/${HOST_NAME}/
                        ssh  ${HOST_NAME}@${REMOTE_HOST} '
                        cd /home/belal &&
                        docker compose down &&
                        docker image rm -f  ${IMAGE_NAME} || true
                        docker compose up -d '
                    """
                }
            }
        }
    }

}
