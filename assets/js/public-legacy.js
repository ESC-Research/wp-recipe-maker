
// Polyfills.
if (!global._babelPolyfill) { require('babel-polyfill'); }
import 'whatwg-fetch';

import './public/comment-rating';
import './public/print';
import './public/smooth-scroll';

import '../css/public/comments.scss';
import '../css/public/print.scss';
import '../css/public/snippets.scss';
import '../css/public/template_reset.scss';

// For roundup template in Legacy mode.
import '../css/shortcodes/_spacer.scss';