# Sourced by the deploy scripts. Loads the server details from
# bin/.deploy.env, which is git-ignored so the host, user and port stay off
# GitHub. Fails before any SSH call if the file or a value is missing.

DEPLOY_ENV_FILE="$(git rev-parse --show-toplevel)/bin/.deploy.env"

if [ ! -f "$DEPLOY_ENV_FILE" ]; then
	echo "Missing bin/.deploy.env - copy bin/.deploy.env.example and fill in the server details." >&2
	exit 1
fi

# shellcheck disable=SC1090
source "$DEPLOY_ENV_FILE"

: "${SSH_KEY:?SSH_KEY is not set in bin/.deploy.env}"
: "${SSH_PORT:?SSH_PORT is not set in bin/.deploy.env}"
: "${SSH_HOST:?SSH_HOST is not set in bin/.deploy.env}"
: "${REMOTE_WP_PATH:?REMOTE_WP_PATH is not set in bin/.deploy.env}"
