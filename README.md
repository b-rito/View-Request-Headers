# View Request Headers
View Request Headers is a repository that contains scripts to install a web service and setup a simple PHP application. The PHP application shows the received HTTP request headers, request URI, and POST variables on an accessible webpage.

> [!Note]  
> Each script is stored in a gist, however each script can be found within this repo

## Setup and Usage
There are two methods that can be referenced for using these scripts. [Manual Method](#manual-method-not-cse) can be used when the machine is already deployed and able to SSH into it to execute the script. [Automatic Method](#automatic-method-cse) can be used when the machine hasn't been deployed and able to use Azure's Custom Script Extension feature.

### Manual Method (Not CSE)
Copy one of the respective commands below which fits your Machine OS and preferred web service. 

Ubuntu with Nginx:
```bash
sudo /bin/bash -c "$(curl -fsSL https://gist.github.com/b-rito/042b325232d950686ac6ac008b34ce2a/raw/3d26cc2cd21a1e07372aab9804a28bdb5e6e5291/nginx-setup.sh)"
```

Ubuntu with Apache:
```bash
sudo /bin/bash -c "$(curl -fsSL https://gist.github.com/b-rito/042b325232d950686ac6ac008b34ce2a/raw/3d26cc2cd21a1e07372aab9804a28bdb5e6e5291/apache-setup.sh)"
```

Rocky with Nginx: 
```bash
sudo /bin/bash -c "$(curl -fsSL https://gist.github.com/b-rito/6e241cbc8a2398b88fac194016ca449d/raw/1451137da0b94f274da8f041480c26da9efd3226/nginx-setup.sh)"
```

Rocky with Apache: 
```bash
sudo /bin/bash -c "$(curl -fsSL https://gist.github.com/b-rito/6e241cbc8a2398b88fac194016ca449d/raw/1451137da0b94f274da8f041480c26da9efd3226/apache-setup.sh)"
```

### Automatic Method (CSE)

Ubuntu with Nginx:
```json
{
  "fileUris": ["https://gist.github.com/b-rito/042b325232d950686ac6ac008b34ce2a/raw/6f183b09017abd0c03ebbdad302da1bed178f3a8/nginx-setup.sh"],
  "commandToExecute": "./nginx-setup.sh"
}
```

Ubuntu with Apache:
```json
{
  "fileUris": ["https://gist.github.com/b-rito/042b325232d950686ac6ac008b34ce2a/raw/6f183b09017abd0c03ebbdad302da1bed178f3a8/apache-setup.sh"],
  "commandToExecute": "./apache-setup.sh"
}
```

Rocky with Nginx:
```json
{
  "fileUris": ["https://gist.github.com/b-rito/6e241cbc8a2398b88fac194016ca449d/raw/286f9ebdb146d577ce6919d9761447a155f5a43a/nginx-setup.sh"],
  "commandToExecute": "./nginx-setup.sh"
}
```

Rocky with Apache:
```json
{
  "fileUris": ["https://gist.github.com/b-rito/6e241cbc8a2398b88fac194016ca449d/raw/286f9ebdb146d577ce6919d9761447a155f5a43a/apache-setup.sh"],
  "commandToExecute": "./apache-setup.sh"
}
```