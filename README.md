<p align="center">
<a href="https://github.com/ardihikaru/ardihikaru.github.io">
<img src="https://lh3.googleusercontent.com/pw/ADCreHfLmIo-6YhfXmEr60xme6Zik2rlGzwyVlTyFwY08GyM23cNlRgYWI1oEgjMlAW_SKJfW7QHcC9G4S8aYlV_cd5HHE0LrTBkIa4kpiVADgXahJlWWaHc_CaN0X6xt3Kg7tCHL7N-JedRSb-aAIVbxTph=w640-h640-s-no?authuser=0" width="30%" />
</a>
<br>
</p>
<p align="center">
<a href="#">
<img src="https://img.shields.io/badge/%20Platforms-Windows%20/%20Linux-blue.svg?style=flat-square" alt="Platforms" />
</a>
<a href="https://github.com/ardihikaru/ardihikaru.github.io/blob/master/LICENSE">
<img src="https://img.shields.io/badge/%20Licence-MIT-green.svg?style=flat-square" alt="license" />
</a>
</p>
<p align="center">
<a href="https://github.com/ardihikaru/ardihikaru.github.io/blob/master/CODE_OF_CONDUCT.md">
<img src="https://img.shields.io/badge/Community-Code%20of%20Conduct-orange.svg?style=flat-squre" alt="Code of Conduct" />
</a>
<a href="https://github.com/ardihikaru/ardihikaru.github.io/blob/master/SUPPORT.md">
<img src="https://img.shields.io/badge/Community-Support-red.svg?style=flat-square" alt="Support" />
</a>
<a href="https://github.com/ardihikaru/ardihikaru.github.io/blob/master/CONTRIBUTING.md">
<img src="https://img.shields.io/badge/%20Community-Contribution-yellow.svg?style=flat-square" alt="Contribution" />
</a>
</p>
<hr>

# Muhammad Febrian Ardiansyah's Official Personal Page


[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-v1.4%20adopted-ff69b4.svg)](CODE_OF_CONDUCT.md)


## Table of Contents

* [Dependencies](#dependencies)
* [Prerequisites](#prerequisites)
* [Installation](#installation)
* [Deployment](#deployment)
* [Usage](#usage)
* [Configurations](#configurations)
* [Contributing](#contributing)
* [License](#license)
* [Misc](#misc)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites (for local deployment)

* `Git` installation (local only)
    * Run this command:
      ```shell
      apt-get -y install git
      ```
      Or
      ```shell
      yum -y install git
      ```
* [Install](https://rvm.io/rvm/install) ruby version manager
  * Install GPG Keys 
    ```shell
    gpg --keyserver keyserver.ubuntu.com --recv-keys 409B6B17
    ```
* Download and install 
  ```shell
  curl -sSL https://get.rvm.io | bash -s stable
  ```
* Add to PATH
  * for `bash shell`
    ```shell
    source /home/ardi/.rvm/scripts/rvm
    ```
  * [for fish shell](https://rvm.io/integration/fish)
    * Download the fish functions from GitHub
      ```shell
      curl -L --create-dirs -o ~/.config/fish/functions/rvm.fish https://raw.github.com/lunks/fish-nuggets/master/functions/rvm.fish
      ```
    * And activate the default Ruby manually in your `config.fish` file
      ```shell
      echo "rvm default" >> ~/.config/fish/config.fish
      ```
    * Finally, make sure that we have install it correctly
      ```shell
      rvm -v
      ```
      And you will get something like this:
      ```shell
      rvm 1.29.12 (latest) by Michal Papis, Piotr Kuczynski, Wayne E. Seguin [https://rvm.io]
      ```
* Install target ruby version (here, I am using version 3.0)
  ```shell
  rvm install 3.0
  ```
* Activate install ruby version (here, I am using version 3.0)
  ```shell
  rvm use 3.0
  ```

### Installation

* Clone the project
  ```shell
  git clone git@github.com:ardihikaru/ardihikaru.github.io.git
  ```
- Bundle
  ```shell
  bundle
  ```

## Deployment

* Native Deployment 
  * Activate the designated ruby version
    ```shell
    rvm use 3.0.0
    ```
  * Run the app
    ```shell
    jekyll serve --watch
    ```
    - FYI: please simply ignore the deprecation warning, since it does not affect how the app works.
    - Anyone is free to contribute to fix this issue (I would be glad). By the time, I will also fix this issue later on.
- Finally, open the app on any web browser: [http://localhost:4000/](http://localhost:4000/)

* Dockerized Deployment
    * TBD

## Usage

* Run the app
    ```shell
    jekyll serve --watch
    ```
    - FYI: please simply ignore the deprecation warning, since it does not affect how the app works.
    - Anyone is free to contribute to fix this issue (I would be glad). By the time, I will also fix this issue later on.
- Finally, open the app on any web browser: [http://localhost:4000/](http://localhost:4000/)

## Configurations

* TBD

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

Looking to contribute to our code but need some help? There's a few ways to get information:

* Connect with me on [LinkedIn](https://www.linkedin.com/in/muhammad-febrian-ardiansyah/)
* Log an issue here on github

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see
the [tags on this repository](https://github.com/ardihikaru/ardihikaru.github.io/tags).

## Authors

* **[Muhammad Febrian Ardiansyah](https://github.com/ardihikaru)**

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Misc

* TBD

<p> Copyright &copy; 2022-2023. All Rights Reserved.</p>
