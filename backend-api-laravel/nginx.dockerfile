FROM nginx:stable-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

RUN addgroup -g 1001 --system brandlistapi
RUN adduser -G brandlistapi --system -D -s /bin/sh -u 1001 brandlistapi
RUN sed -i "s/user  nginx/user brandlistapi/g" /etc/nginx/nginx.conf

COPY ./nginx/conf.d/app.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/brand-list-api
