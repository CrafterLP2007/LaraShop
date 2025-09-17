<?php

namespace App\Attributes;

use Attribute;

/**
 * The ExtensionMeta attribute is used to annotate extension classes with metadata.
 *
 * This attribute provides essential information about an extension, such as its name,
 * description, version, author, and an optional URL for further details. By attaching
 * this attribute to a class, you enable automated discovery and documentation of
 * extensions within the application. This is especially useful for extension management
 * systems, plugin loaders, or administrative interfaces that need to display extension
 * details to users or developers.
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ExtensionMeta
{
    /**
     * Creates a new instance of the ExtensionMeta attribute.
     *
     * @param string $name The display name of the extension. This should be a short, human-readable identifier.
     * @param string $description A brief summary describing the purpose and functionality of the extension.
     * @param string $version The current version of the extension, following semantic versioning if possible.
     * @param string $author The name of the individual or organization that developed the extension.
     * @param string $url (Optional) A link to documentation, support, or further information about the extension.
     */
    public function __construct(
        public string $name,
        public string $description,
        public string $version,
        public string $author,
        public string $url = '',
    ){}
}
