# View Request Headers

View Request Headers is a repository that contains scripts to install a web service and setup a simple PHP application. The PHP application shows the received HTTP request headers, request URI, and POST variables on an accessible webpage.

> [!Note]  
> Script is stored in a gist for accessibility via command line, however can be found within this repo

## Setup and Usage

There are two methods that can be referenced for using this nginx script. One method is for an already deployed VM that you have access to setup Nginx and PHP. The other method is through an Azure template to deploy a VM with a custom script extension.

### Setup on pre-existing machine

Ubuntu with Nginx:

```bash
sudo /usr/bin/env bash -c "$(curl -fsSL https://gist.githubusercontent.com/b-rito/b09da196a3f0c9b510fc85eb115ab064/raw/fba95ccdd004fb6d878ec140cc67a6a8d31909cd/nginx.sh)"
```

### Virtual Machine Deployment via Azure Template

This template assumes you do not have any other resources deployed. Template has _allowed regions_ which are confirmed to have the necessary VM Sku and Image to deploy successfully. Deploys Virtual Machine, Public IP, VNET, and NSGs. Based on [Azure Regions with AZ Support](https://learn.microsoft.com/en-us/azure/reliability/availability-zones-service-support#azure-regions-with-availability-zone-support)

> Allowed Regions:
>
> > America-based: `East US`, `East US 2`, `South Central US`, `West US 3`  
> > Europe-based: `France Central`, `UK South`, `Sweden Central`, `Poland Central`  
> > Other-based: `UAE North`, `South Africa North`, `Central India`, `Southeast Asia`

Through [Azure Cloud Shell](https://shell.azure.com) using below commands to verify pieces of the Template:

```bash
# Verify VM Sku
az vm list-sizes --location EastUS --query "[?name == 'Standard_D2s_v3']" --output table

# Verify Image Offerings
az vm image list --location FranceCentral --query "[?sku == '22_04-lts-gen2']" --output table
```

#### Template Parameters

- Resource Group : Create a new RG or use an existing one
- Region : If creating a new RG, this will be where you deploy the Resource Group (not the resources)
- Location : Allowed values predefined, can choose anyone which will be set on all resources in the template
- Resource Tags : Any values can be set for resource tag, default value is to easily identify the resources this deploys
- Admin Username : Username that will be configured on the VM for access
- Vnet Address Prefix : Must be in X.X.X.X/24 format, default value is optimal if no peerings are expected
- Source Address Prefix or Service Tag : This will be added to the NSGs to allow connectivity from a specific IP or Service Tag you specify
- Ssh Public Key Data : Paste your SSH Public Key here, associated private key will be used to connect to this VM
  - To create SSH Key Pair:

```powershell
# On PowerShell
# Replace your_email with your email
ssh-keygen -t rsa -b 4096 -C "your_email"

# Hit 'enter' for default location
# Use passphrase if preferred
# Use type to get your Public Key
# Copy into template
type .\.ssh\id_rsa.pub
```

```bash
# On Bash
#replace email with your email
ssh-keygen -t rsa -b 4096 -C "your_email"

# Hit 'enter' to use default location
# Use passphrase if preferred
# Use cat to get your Public Key
# Copy into template
cat ~.ssh/id_rsa.pub
```

[![Deploy to Azure](https://aka.ms/deploytoazurebutton)](https://portal.azure.com/#create/Microsoft.Template/uri/https%3A%2F%2Fraw.githubusercontent.com%2Fb-rito%2FView-Request-Headers%2Fmain%2Fazuredeploy.json)

### Example usage

`http://localhost/headers` - if the User-Agent contains 'curl' you will be directed to `curl.php` which has style fitting to a terminal without seeing any HTML tags

`http://localhost/` - if the User-Agent contains 'curl' you will be directed to `index.php` which has style fitting to a terminal without seeing any HTML tags

`http://localhost/curl.php` - will show the View Request Headers, made with the intent to only be used via `curl`

`http://localhost/html.php` - will show the View Request Headers, made with the intent to only be used via browser or Postman

`http://localhost/index.php` - will return a small 'Site is up!' pointing you to `/headers` location for the Request Headers

`http://localhost/index.html` - will return a small 'Site is up!' with a button taking you to `/headers` in the browser
