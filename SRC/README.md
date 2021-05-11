# Setup

## Production

```bash
# Install packages
npm install --production
# Build css and js
# Any unused classes get removed speeding up page load time
npm run build
# Start server
php -S ip:port
```

## Development

```bash
# Install packages
npm install
# Build
npm run dev
# Compile typescript live (when creating typescript code)
npx tsc -w
# Start server
php -S ip:port
```