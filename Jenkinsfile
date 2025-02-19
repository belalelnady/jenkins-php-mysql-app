pipeline {
    agent none
    environment {
        IMAGE_NAME = 'belalelnady/php-mysql-views-counter:latest'
        REMOTE_HOST = '192.168.1.111'
    }
    stages {
        stage('Checkout') {
            agent {label 'ssh-agent'}
            steps {
                // cant use `checkout scm` cuz it will be executed in  every stage 
                git url: 'https://github.com/belalelnady/jenkins-php-mysql-app', branch: 'master'
                stash name: 'github-source', includes: '**'
            }
        }
        
        stage('Build Docker Image and push') {
            agent {label 'jenkins-agent-with-docker'}
            steps {
                unstash 'github-source'
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
                        ssh -o StrictHostKeyChecking=no belal@192.168.1.111 '
                        docker compose -d up  ${IMAGE_NAME}'
                    """
                }
            }
        }
    }
    post {
        agent {label 'ssh-agent'}
        success{
            sh 'echo sucess'
        }
        always {
            sh 'echo "build is finished"'
             cleanWs()
        }
    }
}
