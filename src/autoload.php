<?php
/**
 * Seaf Auto Load
 */
Seaf::di('autoLoader')->addNamespace(
    'Seaf\\View',
    null,
    dirname(__FILE__).'/View'
);

Seaf::register('view', 'Seaf\View\View');
