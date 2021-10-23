FROM laravelsail/php74-composer

RUN apt-get update && apt-get install -y gnupg2 software-properties-common && \
    curl -s https://syncthing.net/release-key.txt | apt-key add - && \
    echo "deb https://apt.syncthing.net/ syncthing stable" | tee /etc/apt/sources.list.d/syncthing.list && \
    apt-get update && apt-get install -y syncthing && \
    apt-get clean

RUN mkdir -p /root/Sync/test && echo "Test" > /root/Sync/test.txt && cp /root/Sync/test.txt /root/Sync/test/subtest.txt

WORKDIR /var/www
EXPOSE 8380

CMD ["syncthing","-no-browser","-gui-address=http://0.0.0.0:8380","-gui-apikey=c180235c30a980484a512472d97f8832"]
