### 1) Installation :  
[Voir documentation vue-ux](https://symfony.com/bundles/ux-vue/current/index.html)
```bash
symfony new my_app --version=lts    # ou "7.2.*"
```
```bash
cd my_app
```
```bash
# À adapter suivant les besoins
composer require \
symfony/twig-pack \
symfony/asset \
symfony/apache-pack \
symfony/orm-pack \
symfony/form \
symfony/serializer-pack \
symfony/security-bundle \
symfony/validator \
symfony/webpack-encore-bundle && npm install && \
composer require symfony/stimulus-bundle \
symfony/ux-vue \
symfony/maker-bundle --dev \
symfony/debug-pack --dev && 
npm install -D vue-loader --force
```
### 2) Configuration pour Vue.js :
- Nettoyer code stiumulus superflu (supprimer les fichiers par défaut dans assets/controllers, voire le dossier complet)
- S'assurer que le fichier booststrap.js charge bien les fichiers Vue :
```javascript
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./vue/controllers',
    true,
    /\.[jt]sx?$/
));
```
- Ainsi que le fichier app.js :
```javascript
import { registerVueControllerComponents } from '@symfony/ux-vue';
import './bootstrap.js';

import './styles/app.css';

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));
```
### 3) Afficher une page :
- Créer un controller et une page
- Appeler un composant Vue dans le template twig :
```html
<div {{ vue_component('Hello', { 'name': 'tristan'}) }}></div>
```
- Lancer un serveur et webpack pour compiler les assets :
```bash
symfony server:start -d
```
```bash
npm run build
```
- Aller sur la page (par défaut localhost:8000)
NB: Il est aussi possible d'utiliser un serveur apache

### 4) Ajouter un serveur de dev avec webpack et donc activer le hot reload:
```bash
npm i webpack-dev-server --save-dev
```
- Ajouter cette configuration dans le fichier webpack.config.js :
```js
Encore
    .configureDevServerOptions(options => {
        options.liveReload = true;
        options.static = {
            watch: false
        };
        options.watchFiles = {
            paths: ['src/**/*.php', 'templates/**/*'],
        };
        
        // Autorise les domaines servis par apache entre autres
        options.allowedHosts = ['all'];
    })
```
- Lancer le serveur de dev :
```bash
npm run dev-server
```