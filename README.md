# tee-tools

Manual build image (Manual deploy)

~~~~
# git clone https://github.com/cheevatee/tee-tools.git
# podman build -t tee-tools .
~~~~

Use S2I (Auto deploy)

~~~~
# oc new-app --name <name_of_pod> https://github.com/cheevatee/tee-tools/
~~~~
