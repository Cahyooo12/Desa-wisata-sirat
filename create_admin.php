<?php
use Illuminate\Support\Facades\DB;
use App\Models\User;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Check if admin exists
    $admin = User::where('email', 'admin@desawisata.com')->first();
    
    if (!$admin) {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@desawisata.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);
        echo "Admin created successfully.\n";
    } else {
        echo "Admin already exists.\n";
        // Optionally update password if needed
        $admin->password = bcrypt('password123');
        $admin->save();
        echo "Admin password reset to 'password123'.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
