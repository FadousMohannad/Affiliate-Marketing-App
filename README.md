# Affiliate-Marketing-App

#please run composer install

#for admins please use this array 
[
            'name'              => 'Mohannad',
            'email'             => 'mohanned.fds@gmail.com',
            'email_verified_at' => now(),
            'role'              => 'admin',
            'password'          => Hash::make('123456789'),
            'remember_token'    => Str::random(10),
        ]
        
 to seed the database with an admin user
