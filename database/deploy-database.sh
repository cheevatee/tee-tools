
MYSQL_DB_NAME=testdb
MYSQL_DB_USERNAME=test
MYSQL_DB_PASSWORD=redhat
MYSQL_DB_PORT=3306

oc new-app --as-deployment-config --name $MYSQL_DB_NAME -e MYSQL_USER=$MYSQL_DB_USERNAME -e MYSQL_PASSWORD=$MYSQL_DB_PASSWORD \
-e MYSQL_DATABASE=$MYSQL_DB_NAME -e MYSQL_AIO=0 --image registry.redhat.io/rhel8/mysql-80

oc patch dc/$MYSQL_DB_NAME --patch '{"spec":{"strategy":{"type":"Recreate"}}}'
oc patch dc/$MYSQL_DB_NAME --type=json -p='[{"op":"remove", "path": "/spec/strategy/rollingParams"}]'

oc set volume dc $MYSQL_DB_NAME --add --type=pvc --claim-name=$MYSQL_DB_NAME-data --claim-size=5G -m /var/lib/mysql

sleep 60


oc get po |grep -i $MYSQL_DB_NAME|grep -v deploy|awk '{print $1}'|xargs -i oc cp create-users-table.sql {}:/tmp/
oc get po |grep -i $MYSQL_DB_NAME|grep -v deploy|awk '{print $1}'|xargs -i oc cp initial-users-data.sql {}:/tmp/

oc get po |grep -i $MYSQL_DB_NAME|grep -v deploy|awk '{print $1}'|xargs -i oc exec {} -- bash -c "mysql -hlocalhost -u$MYSQL_DB_USERNAME -p$MYSQL_DB_PASSWORD -P$MYSQL_DB_PORT $MYSQL_DB_NAME < /tmp/create-users-table.sql"

sleep 5

oc get po |grep -i $MYSQL_DB_NAME|grep -v deploy|awk '{print $1}'|xargs -i oc exec {} -- bash -c "mysql -hlocalhost -u$MYSQL_DB_USERNAME -p$MYSQL_DB_PASSWORD -P$MYSQL_DB_PORT $MYSQL_DB_NAME < /tmp/initial-users-data.sql"

oc expose deploymentconfig $MYSQL_DB_NAME --port=3306 --target-port=3306 --name=$MYSQL_DB_NAME-lb-service --type=LoadBalancer

sleep 5

oc get svc|grep -i $MYSQL_DB_NAME
