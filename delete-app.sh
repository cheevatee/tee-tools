APP_NAME=tee-tools

oc delete deploy $APP_NAME
oc delete svc $APP_NAME
oc delete route $APP_NAME

