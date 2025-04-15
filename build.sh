#!/bin/bash

echo "🧹 Nettoyage du cache Symfony..."
rm -rf var/cache/*
rm -rf var/logs/*

echo "📦 Installation des dépendances PHP..."
composer install --no-dev --optimize-autoloader

echo "🧱 Compilation des assets frontend..."
npm install
npm run build

echo "✅ Tout est prêt, tu peux git add + commit + push."
