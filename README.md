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
Set your `.env` as the following, in the appropriate lines
```
APP_NAME=Despesas
...
DB_DATABASE=despesas
```

## Packages
Start with a package dependency check and installation
```
composer install
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
vagrant up
```
