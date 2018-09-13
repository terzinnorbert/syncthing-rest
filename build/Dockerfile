FROM ubuntu:latest

MAINTAINER Norbert Terzin <terzin.norbert@gmail.com>

RUN export DEBIAN_FRONTEND=noninteractive && apt-get update && apt-get install -y software-properties-common && \
    LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php && apt-get update && apt-get install -y \
    curl acl git unzip gcc make libpng-dev php7.2 php7.2-xml php7.2-gd php7.2-opcache php7.2-mbstring \
    php7.2-tidy php7.2-curl php7.2-xdebug php7.2-zip && \
    curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && \
    a2enmod rewrite expires && \
    apt-get clean

RUN curl -s https://syncthing.net/release-key.txt | apt-key add - && \
    echo "deb https://apt.syncthing.net/ syncthing stable" | tee /etc/apt/sources.list.d/syncthing.list && \
    apt-get update && apt-get install -y syncthing && \
    apt-get clean

RUN mkdir -p /root/Sync/test && echo "Test" > /root/Sync/test.txt && cp /root/Sync/test.txt /root/Sync/test/subtest.txt

WORKDIR /var/www
EXPOSE 8380

CMD ["syncthing","-no-browser","-gui-address=http://localhost:8380","-gui-apikey=c180235c30a980484a512472d97f8832"]
