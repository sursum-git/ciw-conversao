<?php
// Private installation template, never place this file below web/.
// Deployer supplies an existing document root and private key file; no key literal.
require __DIR__.'/AttachmentStorageBroker.php';
require __DIR__.'/AttachmentFilePolicy.php';
return array(
    'root'=>'/var/www/clients/client1/web2/web/ciw/_lib/file/doc',
    'private'=>__DIR__.'/state',
    'secret'=>file_get_contents(__DIR__.'/storage.key'),
);
