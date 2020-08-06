# libmongocrypt #
The companion C library for client side encryption in drivers.

## Documentation ##
See [The Integration Guide](integrating.md) to integrate with your driver.

See [mongocrypt.h.in](src/mongocrypt.h.in) for the public API reference.
The documentation can be rendered into HTML with doxygen. Run `doxygen ./doc/Doxygen`, then open `./doc/html/index.html`.

## Building libmongocrypt ##

First build the following dependencies:

1. [The BSON library (part of the C driver)](https://github.com/mongodb/mongo-c-driver), consisting of libbson. Build it from source.
   ```
   git clone https://github.com/mongodb/mongo-c-driver
   cd mongo-c-driver
   mkdir cmake-build && cd cmake-build
   cmake -DENABLE_MONGOC=OFF -DCMAKE_INSTALL_PREFIX="/path/to/bson-install" -DCMAKE_C_FLAGS="-fPIC" ../
   make -j8 install
   ```
   This installs the library and includes into /path/to/bson-install. The prefix can be omitted if you prefer installing in /usr/local.
   
2. OpenSSL (if on Linux).

Then build libmongocrypt:

```
git clone https://github.com/mongodb/libmongocrypt
cd libmongocrypt
mkdir cmake-build && cd cmake-build
cmake -DCMAKE_C_FLAGS="-fPIC" -DCMAKE_PREFIX_PATH="/path/to/bson-install" ../
make
```

This builds libmongocrypt.dylib and test-libmongocrypt, in the cmake-build directory. Note, the `CMAKE_PREFIX_PATH` must include the path to the BSON library installation directory if it was not the defaults.  Also note that if your project will also dynamically link to the BSON library, you will need to add `-DENABLE_SHARED_BSON=ON` to the `cmake` command line.

## Installing libmongocrypt on macOS ##
First install [Homebrew according to its own instructions](https://brew.sh/). Using Homebrew, install the following dependencies.
```
brew install mongo-c-driver cmake
```

Install the XCode Command Line Tools:
```
xcode-select --install
```

Then clone and build libmongocrypt:
```
git clone https://github.com/mongodb/libmongocrypt.git
cd libmongocrypt
cmake -DENABLE_SHARED_BSON=ON .
cmake --build . --target install
```

Then, libmongocrypt can be used with pkg-config:
```
pkg-config libmongocrypt --libs --cflags
```

Or use cmake's `find_package`:
```
find_package (mongocrypt)
# Then link against mongo::mongocrypt
```

## Installing libmongocrypt on Windows ##
For Windows, there is a fixed URL to download the DLL and includes directory:
https://s3.amazonaws.com/mciuploads/libmongocrypt/windows/latest_release/libmongocrypt.tar.gz

### Testing ###
`test-mongocrypt` mocks all I/O with files stored in the `test/data` and `test/example` directories. Run `test-mongocrypt` from the source directory:

```
cd libmongocrypt
./cmake-build/test-mongocrypt
```

libmongocrypt is [continuously built and published on evergreen](https://evergreen.mongodb.com/waterfall/libmongocrypt). Submit patch builds to this evergreen project when making changes to test on supported platforms.
The latest tarball containing libmongocrypt built on all supported variants is [published here](https://s3.amazonaws.com/mciuploads/libmongocrypt/all/master/latest/libmongocrypt-all.tar.gz).

### Troubleshooting ###
If OpenSSL is installed in a non-default directory, pass `-DOPENSSL_ROOT_DIR=/path/to/openssl` to the cmake command for libmongocrypt. 

If there are errors with cmake configuration, send the set of steps you performed to the maintainers of this project.

If there are compilation or linker errors, run `make` again, setting `VERBOSE=1` in the environment or on the command line (which shows exact compile and link commands), and send the output to the maintainers of this project.

### Design Principles ###
The design of libmongocrypt adheres to these principles.

#### Easy to integrate ####
The main reason behind creating a C library is to make it easier for drivers to support FLE. Some consequences of this principle: the API is minimal, structs are opaque, and global initialization is lazy.

#### Lightweight ####
We decided against the "have libmongocrypt do everything" approach because it complicated integration, especially with async drivers. Because of this we decided no I/O occurs in libmongocrypt.

#### Narrowly scoped ####
The first version of FLE is to get signal. If FLE becomes popular, further improvements will be made (removing mongocryptd process, support for more queries, better performance). libmongocrypt takes the same approach. Making it blazing fast and completely future-proof is not a high priority.

### Releasing ###

#### Version number scheme ####
Version numbers of libmongocrypt must follow the format 1.[0-9].[0-9] for releases and 1.[0-9].[0-9]-rc[0-9] for release candidates.  This ensures that Linux distribution packages built from each commit are published to the correct location.

#### Steps to release ####
Do the following when releasing:
- In the Java binding build.gradle.kts, replace `version = "1.0.0-SNAPSHOT"` with `version = "1.0.0-rc123"`.
- Commit, create a new git tag, like `1.0.0-rc123`, and push.
- In the Java binding build.gradle.kts, replace `version = "1.0.0-rc123"` with `version = "1.0.0-SNAPSHOT"` (i.e. undo the change). For an example of this, see [this commit](https://github.com/mongodb/libmongocrypt/commit/2336123fbc1f4f5894f49df5e6320040987bb0d3) and its parent commit.
- Commit and push.
- Create a BUILD ticket to update the version of libmongocrypt installed on Evergreen hosts.

## Installing libmongocrypt From Distribution Packages ##
Distribution packages (i.e., .deb/.rpm) are built and published for several Linux distributions.  The installation of these packages for supported platforms is documented here.

### .deb Packages (Debian and Ubuntu) ###

First, import the public key used to sign the package repositories:

```
sudo sh -c 'curl -s https://www.mongodb.org/static/pgp/libmongocrypt.asc | gpg --dearmor >/etc/apt/trusted.gpg.d/libmongocrypt.gpg'
```

Second, create a list entry for the repository.  For Ubuntu systems (be sure to change `<release>` to `xenial` or `bionic`, as appropriate to your system):

```
echo "deb https://libmongocrypt.s3.amazonaws.com/apt/ubuntu <release>/libmongocrypt/1.0 universe" | sudo tee /etc/apt/sources.list.d/libmongocrypt.list
```

For Debian systems (be sure to change `<release>` to `stretch` or `buster`, as appropriate to your system):

```
echo "deb https://libmongocrypt.s3.amazonaws.com/apt/debian <release>/libmongocrypt/1.0 main" | sudo tee /etc/apt/sources.list.d/libmongocrypt.list
```

Third, update the package cache:

```
sudo apt-get update
```

Finally, install the libmongocrypt packages:

```
sudo apt-get install -y libmongocrypt-dev
```

### .rpm Packages (RedHat, Suse, and Amazon) ###


#### RedHat Enterprise Linux ####

Create the file `/etc/yum.repos.d/libmongocrypt.repo` with contents:

```
[libmongocrypt]
name=libmongocrypt repository
baseurl=https://libmongocrypt.s3.amazonaws.com/yum/redhat/$releasever/libmongocrypt/1.0/x86_64
gpgcheck=1
enabled=1
gpgkey=https://www.mongodb.org/static/pgp/libmongocrypt.asc
```

Then install the libmongocrypt packages:

```
sudo yum install -y libmongocrypt
```

#### Amazon Linux 2 ####

Create the file `/etc/yum.repos.d/libmongocrypt.repo` with contents:

```
[libmongocrypt]
name=libmongocrypt repository
baseurl=https://libmongocrypt.s3.amazonaws.com/yum/amazon/2/libmongocrypt/1.0/x86_64
gpgcheck=1
enabled=1
gpgkey=https://www.mongodb.org/static/pgp/libmongocrypt.asc
```

Then install the libmongocrypt packages:

```
sudo yum install -y libmongocrypt
```

#### Amazon Linux ####

Create the file `/etc/yum.repos.d/libmongocrypt.repo` with contents:

```
[libmongocrypt]
name=libmongocrypt repository
baseurl=https://libmongocrypt.s3.amazonaws.com/yum/amazon/2013.03/libmongocrypt/1.0/x86_64
gpgcheck=1
enabled=1
gpgkey=https://www.mongodb.org/static/pgp/libmongocrypt.asc
```

Then install the libmongocrypt packages:

```
sudo yum install -y libmongocrypt
```

#### Suse ####

First, import the public key used to sign the package repositories:

```
sudo rpm --import https://www.mongodb.org/static/pgp/libmongocrypt.asc
```

Second, add the repository (be sure to change `<release>` to `12` or `15`, as appropriate to your system):

```
sudo zypper addrepo --gpgcheck "https://libmongocrypt.s3.amazonaws.com/zypper/suse/<release>/libmongocrypt/1.0/x86_64" libmongocrypt
```

Finally, install the libmongocrypt packages:

```
sudo zypper -n install libmongocrypt
```
