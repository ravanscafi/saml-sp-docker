# SAML Service Provider Test

Use a preconfigured service provider to test your own Identity Provider (IdP).

## Setup

You only need Docker and Docker-Compose.

```bash
cp docker-compose.override.yml.example docker-compose.override.yml
# Now edit your docker-compose.override.yml file with proper info about IdP
docker-compose build
docker-compose up -d
docker-compose exec sp composer install
```

Then access [http://localhost:8000](http://localhost:8000).
You should be able to see the default page.

If you need to change something, take a look at [settings.php](./settings.php)

## Relevant information
You must configure your IdP with whatever of these info they ask:
- The service name is `SP test`
- The return URL is `http://localhost:8000/acs.php`
- The metadata URL is at `http://localhost:8000/metadata.php`
- The login URL is at `http://localhost:8000/login.php`

## Running
After everything is configured, just start SAML flow on [http://localhost:8000/login.php](http://localhost:8000/login.php)
and you are ready to go.
You should be redirected to your `IDP_SSO_URL` and after authentication,
you should be redirected back to `/acs.php` and be able to see info about user.
