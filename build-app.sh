APP_NAME=tee-tools
OPENSHIFT_PROJECT=tee
OPENSHIFT_REGISTRY_ROUTE=default-route-openshift-image-registry.apps.cluster-wbl6h.wbl6h.sandbox1085.opentlc.com

podman login -u $(oc whoami) -p $(oc whoami -t) $OPENSHIFT_REGISTRY_ROUTE
podman build -t $APP_NAME .
podman tag localhost/$APP_NAME:latest $OPENSHIFT_REGISTRY_ROUTE/$OPENSHIFT_PROJECT/$APP_NAME:latest
podman push $OPENSHIFT_REGISTRY_ROUTE/$OPENSHIFT_PROJECT/$APP_NAME:latest
