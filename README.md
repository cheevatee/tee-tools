# tee-tools

Manual build image (Manual deploy)

~~~~
# git clone https://github.com/cheevatee/tee-tools.git
# podman build -t tee-tools .
~~~~

Use S2I (Auto deploy)

~~~~
# oc new-app --name <name_of_pod> https://github.com/cheevatee/tee-tools.git
~~~~

Istio

~~~~
# oc new-app --name red-mesh-web-1 -l version=1.0,app=red-mesh-web-1 https://github.com/cheevatee/tee-tools.git
# oc new-app --name red-mesh-web-2 -l version=2.0,app=red-mesh-web-2 https://github.com/cheevatee/tee-tools.git
# oc new-app --name red-mesh-web-3 -l version=3.0,app=red-mesh-web-3 https://github.com/cheevatee/tee-tools.git
# oc get deploy|grep -v NAME | awk '{print $1 }' | xargs -i oc patch deploy {} -p "{\"spec\":{\"template\":{\"metadata\":{\"annotations\":{\"sidecar.istio.io\/inject\":\"true\"}}}}}"
# while true; do curl -s -o /dev/null http://red-mesh-web.apps.<cluster-id>.<base-domain>; done
~~~~
