<?php

use \Firegento\ContentProvisioning\Api\Data\PageEntryInterface;
use \Firegento\ContentProvisioning\Api\Data\BlockEntryInterface;
use Magenerds\PageDesigner\Constants;

return [
    'pages' => [
        'test.page.no.json' => [
            PageEntryInterface::TITLE => 'Test Page 1',
            PageEntryInterface::CONTENT => file_get_contents(__DIR__ . '/test-files/file-1.html'),
            PageEntryInterface::KEY => 'test.page.no.json',
            PageEntryInterface::IDENTIFIER => 'test-page-no-json',
            PageEntryInterface::IS_ACTIVE => true,
            PageEntryInterface::IS_MAINTAINED => true,
            PageEntryInterface::STORES => ['admin'],
            PageEntryInterface::CONTENT_HEADING => '',
        ],
        'test.page.with.json.1' => [
            PageEntryInterface::TITLE => 'Title 2',
            PageEntryInterface::CONTENT => file_get_contents(__DIR__ . '/test-files/file-1.html'),
            PageEntryInterface::CONTENT_HEADING => 'New Page Heading 2',
            PageEntryInterface::KEY => 'test.page.with.json.1',
            PageEntryInterface::IDENTIFIER => 'test-page-with-json-1',
            PageEntryInterface::IS_ACTIVE => false,
            PageEntryInterface::IS_MAINTAINED => false,
            PageEntryInterface::STORES => ['default', 'admin'],
            Constants::ATTR_PAGE_DESIGNER_JSON => file_get_contents(__DIR__ . '/test-files/example-1.json'),
        ],
        'test.page.with.json.2' => [
            PageEntryInterface::TITLE => 'Title 2',
            PageEntryInterface::CONTENT => file_get_contents(__DIR__ . '/test-files/file-1.html'),
            PageEntryInterface::CONTENT_HEADING => 'New Page Heading 2',
            PageEntryInterface::KEY => 'test.page.with.json.2',
            PageEntryInterface::IDENTIFIER => 'test-page-with-json-2',
            PageEntryInterface::IS_ACTIVE => false,
            PageEntryInterface::IS_MAINTAINED => false,
            PageEntryInterface::STORES => ['default', 'admin'],
            Constants::ATTR_PAGE_DESIGNER_JSON => '{"version": "1.0.0", "rows": [{"test": 1},{"test": 2}]}',
        ]
    ],
    'blocks' => [
        'test.block.no.json' => [
            BlockEntryInterface::TITLE => 'Test Block 1',
            BlockEntryInterface::CONTENT => file_get_contents(__DIR__ . '/test-files/file-1.html'),
            BlockEntryInterface::KEY => 'test.block.no.json',
            BlockEntryInterface::IDENTIFIER => 'test-block-no-json',
            BlockEntryInterface::IS_ACTIVE => true,
            BlockEntryInterface::IS_MAINTAINED => true,
            BlockEntryInterface::STORES => ['admin'],
        ],
        'test.block.with.json.1' => [
            BlockEntryInterface::TITLE => 'Test Block 1',
            BlockEntryInterface::CONTENT => file_get_contents(__DIR__ . '/test-files/file-1.html'),
            BlockEntryInterface::KEY => 'test.block.with.json.1',
            BlockEntryInterface::IDENTIFIER => 'test-block-with-json-1',
            BlockEntryInterface::IS_ACTIVE => true,
            BlockEntryInterface::IS_MAINTAINED => false,
            BlockEntryInterface::STORES => ['admin'],
            Constants::ATTR_PAGE_DESIGNER_JSON => '{"version": "1.0.0", "rows": []}',
        ],
        'test.block.with.json.2' => [
            BlockEntryInterface::TITLE => 'Test Block 1',
            BlockEntryInterface::CONTENT => '<h2>foo</h2>',
            BlockEntryInterface::KEY => 'test.block.with.json.2',
            BlockEntryInterface::IDENTIFIER => 'test-block-with-json-2',
            BlockEntryInterface::IS_ACTIVE => false,
            BlockEntryInterface::IS_MAINTAINED => true,
            BlockEntryInterface::STORES => ['admin'],
            Constants::ATTR_PAGE_DESIGNER_JSON => file_get_contents(__DIR__ . '/test-files/example-1.json'),
        ],
    ],
];
