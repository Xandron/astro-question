FROM openjdk:8-jre-slim

ARG ALLURE_VERSION=2.13.8

RUN apt-get update  \
    && apt-get install -y --no-install-recommends \
    curl

RUN curl -o allure-commandline-${ALLURE_VERSION}.tgz -Ls https://repo.maven.apache.org/maven2/io/qameta/allure/allure-commandline/${ALLURE_VERSION}/allure-commandline-${ALLURE_VERSION}.tgz  \
    && tar -zxvf allure-commandline-${ALLURE_VERSION}.tgz -C /opt/ && ln -s /opt/allure-commandline-${ALLURE_VERSION}/bin/allure /usr/bin/allure  \
    && rm -f allure-commandline-${ALLURE_VERSION}.tgz
RUN apt-get remove -y curl \
    && rm -rf /var/lib/apt/lists/*
ENV PATH="$PATH:/opt/allure-${ALLURE_VERSION}/bin"

ARG USER_ID=1000
ARG GROUP_ID=1000
RUN userdel -f www-data \
    && if getent group www-data ; then groupdel www-data; fi \
    && groupadd -g ${GROUP_ID} www-data \
    && useradd -l -u ${USER_ID} -g www-data www-data \
    && install -d -m 0755 -o www-data -g www-data /home/www-data

RUN chown --changes --silent --no-dereference --recursive  ${USER_ID}:${GROUP_ID}  \
    /home/www-data  \
    /opt/allure-${ALLURE_VERSION} \
    $ROOT$RESULTS_DIRECTORY || true

USER www-data

WORKDIR /var/www

CMD allure generate --clean $ROOT$RESULTS_DIRECTORY --report-dir $ROOT$REPORT_DIRECTORY \
     && exit 0
