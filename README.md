# Despesas (Expenses)
This project aims at providing a way to manage the domestic monetary transactions, somehow integrated with the online homebanking, and to give an overall view of the way money is being spent

# Installation for development
We'll assume you are using Homestead, so our suggestions we'll be acordingly

## Homestead
In your Homestead.yaml, name the database as `despesas`
```
databases:
    - despesas
```

## .env
The .env.example is already set Homestead wise. Just don't forget to make the necessary adjustments to your environment (APP_URL, etc)

## Packages
Start with a package dependency check and installation
```
composer install
```

### tymondesigns/jwt-auth
To generate a local JWT key, run
```
php artisan jwt:secret
```

## Migrate and seed
Build and populate the database with some test data, just run
```
php artisan migrate --seed
```

## Troubleshooting

### App responses are very slow
If you are running Windows and are using Homestead, [enabling NFS support](http://iteration9.com/2015/using-laravel-homestead-on-windows/) may help

Add this line to your folders mapping in `c:\path\to\Homestead\Homestead.yaml`:
```
type: "nfs"
```

Then install this two plugins in your box
```
vagrant plugin install vagrant-vbguest
vagrant plugin install vagrant-winnfsd
vagrant plugin install vagrant-bindfs
```

Finnaly, in `c:\path\to\Homestead\scripts\homestead.rb` add this to the end of the `def Homestead.configure` block:
```
# Sort folders to keep vagrant-winnfsd happy
settings["folders"].sort! { |a,b| a["map"].length <=> b["map"].length }

# Add synced folders using NFS
settings["folders"].each do |folder|
    config.vm.synced_folder folder["map"], folder["to"],
    id: folder["map"],
    :nfs => true,
    :mount_options => ['nolock,vers=3,udp,noatime']
end
```

If your box was already up, you should first destroy it (beware of your DB data!)
```
vagrant destroy
vagrant up --provision
```
