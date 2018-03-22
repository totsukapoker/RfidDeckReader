#!/usr/bin/env python

import os
import nfc

def connected(tag):
    print('\a')
    os.system('./sender.php ' + tag.identifier.encode('hex').upper())
    return True

clf = nfc.ContactlessFrontend('usb')
while clf.connect(rdwr={
    'on-connect': connected,
}):
    pass
