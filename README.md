# tee-tools

## Manual build image (Manual deploy)

~~~~
# git clone https://github.com/cheevatee/tee-tools.git
# podman build -t tee-tools .
~~~~

or (Check/Edit variables before run scripts.)

~~~~
# ./build-app.sh
# ./deploy-app.sh
~~~~

### Not connect to database
~~~~
oc new-app --name <name_of_pod> <image_stream> -e OPENSHIFT_MYSQL_DB_HOST=<database_host> -e OPENSHIFT_MYSQL_DB_NAME=<database_name> -e OPENSHIFT_MYSQL_DB_PORT=<database_port|3306> -e OPENSHIFT_MYSQL_DB_USERNAME=<database_user> -e OPENSHIFT_MYSQL_DB_PASSWORD=<database_password>
~~~~

### Connect to database
~~~~
oc new-app --name <name_of_pod> <image_stream> -e OPENSHIFT_MYSQL_DB_HOST=<database_host> -e OPENSHIFT_MYSQL_DB_NAME=<database_name> -e OPENSHIFT_MYSQL_DB_PORT=<database_port|3306> -e OPENSHIFT_MYSQL_DB_USERNAME=<database_user> -e OPENSHIFT_MYSQL_DB_PASSWORD=<database_password>
~~~~

## Use S2I (Auto deploy)

### Not connect to database
~~~~
# oc new-app --name <name_of_pod> https://github.com/cheevatee/tee-tools.git
~~~~

### Connect to database
~~~~
# oc new-app --name <name_of_pod> https://github.com/cheevatee/tee-tools.git -e OPENSHIFT_MYSQL_DB_HOST=<database_host> -e OPENSHIFT_MYSQL_DB_NAME=<database_name> -e OPENSHIFT_MYSQL_DB_PORT=<database_port|3306> -e OPENSHIFT_MYSQL_DB_USERNAME=<database_user> -e OPENSHIFT_MYSQL_DB_PASSWORD=<database_password>
~~~~

## Deploy database

(Check/Edit variables before run scripts.)

~~~~
# cd database
# ./deploy-database.sh
~~~~

## Istio

~~~~
# oc new-app --name red-mesh-web-1 -l version=1.0,app=red-mesh-web-1 https://github.com/cheevatee/tee-tools.git
# oc new-app --name red-mesh-web-2 -l version=2.0,app=red-mesh-web-2 https://github.com/cheevatee/tee-tools.git
# oc new-app --name red-mesh-web-3 -l version=3.0,app=red-mesh-web-3 https://github.com/cheevatee/tee-tools.git
# oc get deploy|grep -v NAME | awk '{print $1 }' | xargs -i oc patch deploy {} -p "{\"spec\":{\"template\":{\"metadata\":{\"annotations\":{\"sidecar.istio.io\/inject\":\"true\"}}}}}"
# oc create -f https://raw.githubusercontent.com/cheevatee/tee-tools/main/istio/destinationrules-all.yaml
# oc create -f https://raw.githubusercontent.com/cheevatee/tee-tools/main/istio/gateway.yaml
# while true; do curl -s -o /dev/null http://red-mesh-web.apps.<cluster-id>.<base-domain>; done
~~~~
