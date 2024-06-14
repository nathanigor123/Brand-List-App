# Serve Application using Nginx Server
FROM nginx:stable-alpine

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

RUN addgroup -g 1001 --system brandlistclient
RUN adduser -G brandlistclient --system -D -s /bin/sh -u 1001 brandlistclient
RUN sed -i "s/user  nginx/user brandlistclient/g" /etc/nginx/nginx.conf

COPY ./nginx/conf.d/app.conf /etc/nginx/conf.d/

#### Copy existing application directory contents to the working directory
COPY . /usr/share/nginx/html

EXPOSE 80

CMD ["nginx","-g","daemon off;"]