# html-tansh
Runs the HTML and some PHP in a docker container.

To run the container, cd into the directory and build and run.


```
$ docker build -t biswas/tansh-html:v0.1-SNAPSHOT .
$ docker run --name html -d -p 80:80 -p 443:443 -v "$PWD/src:/usr/share/nginx/html" biswas/tansh-html:v0.1-SNAPSHOT
```