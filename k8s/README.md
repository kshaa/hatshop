# Deploying Hatshop to Kubernetes
## Build
You have to build a hatshop docker image with the latest code
and without `/.env`, `/vendor`, i.e. a latest sterile image.

```bash
# Build
make build
make tag VERSION_TAG=1.0.2
make push VERSION_TAG=1.0.2
```

## Deployment
This deployment is full of hardcoded values and resources.  
It should be rewritten w/ Helm templates for customizability.  

``` bash
# Deploy secrets
## Sidenote: `from-env-file cannot be combined with from-file or from-literal`
kubectl create secret generic hatshopconfigs \
    --from-file=secrets \
    --from-literal=ping=pong

kubectl create secret generic hatshopenv \
    --from-env-file=secrets/generic.env
```

``` bash
# Optionally - Update latest image versions used in k8s manifests
VERSION_TAG=1.0.3; sed -i "s/\(blokflautijs\/hatshop.*:\).*/\1${VERSION_TAG}/g" 03-php.yaml
VERSION_TAG=1.0.3; sed -i "s/\(blokflautijs\/hatshop.*:\).*/\1${VERSION_TAG}/g" 04-nginx.yaml
    
# Deploy
## -f: filename that contains configurations
## -R: "-f is a directory" & "process recursively"
## ./: current directory
kubectl apply -R -f ./
```

```bash
# Bootstrap database
export POD_NAME=$(kubectl get pods -l "app=hatshop-php" -o jsonpath="{.items[0].metadata.name}")

## Link hat model storage as public
kubectl exec $POD_NAME php artisan storage:link

## Create database structure & seed it
kubectl exec $POD_NAME -- php artisan --force migrate:fresh
kubectl exec $POD_NAME -- php artisan --force db:seed
```