
MYSQL_DB_NAME=testdb

oc delete dc $MYSQL_DB_NAME
oc delete svc $MYSQL_DB_NAME $MYSQL_DB_NAME-lb-service
oc delete pvc $MYSQL_DB_NAME-data
