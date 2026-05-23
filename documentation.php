<?php

/**
 * On-site documentation manifest for the Site Documentation plugin.
 * Markdown sources live in this theme under docs/content/{locale}/*.md.
 */
return [

    'sections' => [
        'Getting started' => [
            ['slug' => 'start-here', 'title' => 'documentation.toc.start_here', 'description' => 'documentation.meta.description.start_here'],
            ['slug' => 'overview', 'title' => 'documentation.toc.overview', 'description' => 'documentation.meta.description.overview'],
            ['slug' => 'installation', 'title' => 'documentation.toc.installation', 'description' => 'documentation.meta.description.installation'],
            ['slug' => 'glossary', 'title' => 'documentation.toc.glossary', 'description' => 'documentation.meta.description.glossary'],
            [
                'slug' => 'about-nebulacms',
                'title' => 'documentation.toc.about_nebulacms',
                'description' => 'documentation.meta.description.about_nebulacms',
            ],
        ],
        'Core' => [
            ['slug' => 'configuration', 'title' => 'documentation.toc.configuration', 'description' => 'documentation.meta.description.configuration'],
            ['slug' => 'admin-basics', 'title' => 'documentation.toc.admin_basics', 'description' => 'documentation.meta.description.admin_basics'],
            ['slug' => 'admin-reference', 'title' => 'documentation.toc.admin_reference', 'description' => 'documentation.meta.description.admin_reference'],
            ['slug' => 'content-model', 'title' => 'documentation.toc.content_model', 'description' => 'documentation.meta.description.content_model'],
            ['slug' => 'media', 'title' => 'documentation.toc.media', 'description' => 'documentation.meta.description.media'],
            ['slug' => 'frontend-routing', 'title' => 'documentation.toc.frontend_routing', 'description' => 'documentation.meta.description.frontend_routing'],
        ],
        'Themes & extensions' => [
            ['slug' => 'theme-system', 'title' => 'documentation.toc.theme_system', 'description' => 'documentation.meta.description.theme_system'],
            ['slug' => 'hooks-and-filters', 'title' => 'documentation.toc.hooks_and_filters', 'description' => 'documentation.meta.description.hooks_and_filters'],
            ['slug' => 'static-pages', 'title' => 'documentation.toc.static_pages', 'description' => 'documentation.meta.description.static_pages'],
            ['slug' => 'plugin-development', 'title' => 'documentation.toc.plugin_development', 'description' => 'documentation.meta.description.plugin_development'],
        ],
        'API & operations' => [
            ['slug' => 'rest-api', 'title' => 'documentation.toc.rest_api', 'description' => 'documentation.meta.description.rest_api'],
            ['slug' => 'operations', 'title' => 'documentation.toc.operations', 'description' => 'documentation.meta.description.operations'],
            ['slug' => 'security', 'title' => 'documentation.toc.security', 'description' => 'documentation.meta.description.security'],
        ],
        'Extended references' => [
            [
                'slug' => 'theme-documentation-full',
                'title' => 'documentation.toc.theme_documentation_full',
                'description' => 'documentation.meta.description.theme_documentation_full',
            ],
            [
                'slug' => 'theme-development-guide-full',
                'title' => 'documentation.toc.theme_development_guide_full',
                'description' => 'documentation.meta.description.theme_development_guide_full',
            ],
            [
                'slug' => 'hooks-and-templates-full',
                'title' => 'documentation.toc.hooks_and_templates_full',
                'description' => 'documentation.meta.description.hooks_and_templates_full',
            ],
            [
                'slug' => 'static-pages-full',
                'title' => 'documentation.toc.static_pages_full',
                'description' => 'documentation.meta.description.static_pages_full',
            ],
        ],
    ],

];
