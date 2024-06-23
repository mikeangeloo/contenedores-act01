FROM node:latest as build

WORKDIR /usr/proyects/water-app

COPY ./project /usr/projects/water-app

RUN <<EOF
apt-get update
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion" # This loads nvm bash_completion

nvm install 16.14.0
nvm use 16.14.0
nvm default 16.14.0
node -v
npm -v

npm install

npm run build
EOF


# Paso 2
FROM nginx:latest

COPY --from=build /usr/projects/water-app/dist/water-app-demo /usr/share/nginx/html

# Copy the nginx file to fix fallback issue on refreshing.
COPY ./config/nginx.conf /etc/nginx/conf.d/default.conf

# Expose port 80
EXPOSE 9003