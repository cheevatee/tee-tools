# ubi-image

Manual build image (Manual deploy)

~~~~
# git clone https://github.com/cheevatee/ubi-image.git
# podman build -t rhel-test .
~~~~

Use S2I (Auto deploy)

~~~~
# oc new-app --name <name_of_pod> https://github.com/cheevatee/ubi-image/
~~~~
