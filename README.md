# URLs shortener

[![laravel](https://img.shields.io/badge/Laravel-v9.11-ff1e12?logo=laravel)](https://laravel.com/docs/9.x)
[![vue](https://img.shields.io/badge/Vue.js-v2.6.14-33b378?logo=vuedotjs)](https://v2.vuejs.org/)
[![vue-router](https://img.shields.io/badge/Vue%20Router-v3.5.3-33b378)](https://v3.router.vuejs.org/)
[![vuetify](https://img.shields.io/badge/Bootstrap-v5.1.3-6a2ff9?logo=bootstrap)](https://getbootstrap.com/docs/5.1/getting-started/introduction/)
[![vue-router](https://img.shields.io/badge/Axios-v0.25-4e25e3?logo=axios)](https://axios-http.com/)
[![vue-router](https://img.shields.io/badge/Google%20Safe%20Browsing-v4-1b792f?logo=google)](https://developers.google.com/safe-browsing/v4)

The system generates a short unique URL with 6 hash symbols, which contains alphanumeric symbols, and works from a folder (e.g.: example.com/something/[hash]).

The algorithm recognizes duplicate URLs and instead of generating new short URLs, shows previously created URLs.

URL checked using the ["Google Safe Browsing" API](https://developers.google.com/safe-browsing/v4).
