Laracon Ember Example
---

This is a basic persisted blog using Laravel, EmberCLI, and Vagrant.

This shows a basic application with relationships and how you could attack them both on the API side with Laravel and the Ember side.

Getting Started
---

You should be able to run `./ember-setup` which will require `npm` and `bower` to be installed in your PATH.
Then to start the API server run `vagrant up`.
Finally, run `./ember-server` which will start the Ember CLI server with all API requests proxied to `192.168.22.10` where our API lives.
