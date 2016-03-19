# Introduction
Powerline is an open, social, streamlined mobile app and web platform that makes it easier for people to change their world through individual or collective action at the local and global levels. Think of it as Twitter/Yammer for democracy or as a community network for civil society (a.k.a. the non-profit and activist space).

Learn more through the #no longer exist [Detailed Overview](https://assembly.com/powerline/posts/the-detailed-overview).
For new contributors and general questions, check out the #no longer exist [FAQ](https://assembly.com/powerline/posts/faq)

## Open Source
Powerline is now open source under the AGPL license for development with the Assembly community. Powerline runs as a SaaS application – there is a free “mission” tier as well as paid upgrade plans. With the Assembly platform, all generated revenue from the product is funneled into the project and it's contributors. After subtracting hosting costs and other expenses, 10% goes to Assembly as a fee and the rest is distributed back to project contributors via Assembly based on their ownership (determined by their project contributions).

By contributing to Powerline, you’re making a difference for a fun open source project with a real world-changing mission and, unlike traditional OSS, you’re earning your fair share of the profits, too. To get started simply join us on our #no longer exist [Assembly Project Page](https://assembly.com/powerline).


## Server DEV Setup 

### Bootstrap
#### Build the image
` vagrant up `

#### Log in to the instance
` vagrant ssh`

### Build Database
```
php app/console doctrine:database:create
php app/console doctrine:migration:migrate -n
```

### Cache / Asset
Although we are hard at work building our new Leader experience, admin.powerli.ne serves as our interim Leader portal. It is built on the symfony framework. At this point, few if any Pull Requests will be merged for symfony backed Leader work. Please see the [Powerline Web App](https://github.com/PowerlineApp/powerline-web) or contact us before moving forward.

#### Cache
```
/vagrant/backend/app/console cache:clear -e=prod
/vagrant/backend/app/console cache:clear -e=dev
/vagrant/backend/app/console cache:clear -e=test_behat
```

#### Assets
```
/vagrant/backend/app/console assetic:dump -e=prod
/vagrant/backend/app/console assets:install --symlink
```

### Tests

#### Behat
```
/vagrant/backend/bin/behat -p admin
/vagrant/backend/bin/behat -p api
```

#### Load testing
* The config for jMeter (url should be modified according to your local (test) server: backend/src/Civix/LoadBundle/Resources/jmeter/CivixLoadTesting.jmx

* Fixtures (db will be dropped!):
```
backend/app/console load:scenario --10000
backend/app/console load:scenario --100000
backend/app/console load:scenario --1000000
```

## Contributing
Want to help build an amazing product? Check out our [Powerline Assembly Project](https://assembly.com/powerline) for all the latest bounties and roadmap. We follow the [GitHub Flow](https://guides.github.com/introduction/flow/index.html) model so pull requests are easy! Although you don’t have to create a feature branch, it helps streamline the merge process.


## Branching
Our branching strategy is straightforward and well documented . For a detailed look please see [A successful Branching Model](http://nvie.com/posts/a-successful-git-branching-model/). 

### Branches
* develop - Our main branch for all features
* master - Production ready code
* feature - Your feature branch (temporary branch)
* release-*, hotfix-* - temporary branches 


## Documentation
**Work in progress. Please help us build our documentation!**
Check out all of our documentation for more details include our API [PowerlineApp Documentation](http://powerlineapp.github.io/).

 
## Pull Request & Claiming your Bounty
When your code is ready and on GitHub, create a pull request via the GitHub UI. Once your pull request is created, it is best practice to go to the bounty on Assembly and submit your work with a link to the pull request. If the feature you created does not have a bounty created yet, simply create one explaining what you've done and why. The core team will award the bounty after confirming and merging the contribution. We recommend you include the appropriate unit tests to make things easier for everyone. 

After the bounty or work is submitted, add a comment to the pull request with a link to the bounty. This keeps the code review and merging process quick and easy.
